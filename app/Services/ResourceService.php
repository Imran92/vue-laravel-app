<?php

namespace App\Services;

use App\Constants\ResourceTypes;
use App\Contracts\Repositories\ResourceRepositoryInterface;
use App\Contracts\Services\ResourceServiceInterface;
use App\Models\ResourceItem;
use App\Repositories\ResourceRepository;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;
use Illuminate\Validation\Rule;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Utils;

class ResourceService implements ResourceServiceInterface
{
    /**
     * @var $resourceRepository
     */
    protected $resourceRepository;

    /**
     * ResourceService constructor.
     *
     * @param ResourceRepository $resourceRepository
     */
    public function __construct(ResourceRepositoryInterface $resourceRepository)
    {
        $this->resourceRepository = $resourceRepository;
    }

    public function getValidationArray($type, $isEdit = false) : array
    {
        $validationArray = [
            'itemTitle' => 'required|string|max:30',
            'resourceType' => Rule::in([ResourceTypes::SNIPPET, ResourceTypes::PDF,ResourceTypes::URL])
        ];
        switch ($type){
            case ResourceTypes::SNIPPET:
                $validationArray['htmlsnippet'] = 'required|string|max:2048';
                $validationArray['description'] = 'required|string|max:2048';
                break;
            case ResourceTypes::PDF:
                $validationArray['pdf'] = ($isEdit ? 'nullable|sometimes|' : 'required|').'mimes:pdf|max:2048';
                break;
            case ResourceTypes::URL:
                $validationArray['url'] = 'required|url|max:2048';
                $validationArray['newtab'] = 'required|boolean';
                break;
        }
        return $validationArray;
    }
    /**
     * Delete resource by id.
     *
     * @param $id
     * @return int
     */
    public function deleteById($id) : int
    {
        DB::beginTransaction();

        try {
            $resp = $this->resourceRepository->delete($id);
        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());

            throw new InvalidArgumentException('Unable to delete resource data');
        }

        DB::commit();

        return $resp;

    }

    /**
     * Get all resource.
     *
     * @return Collection
     */
    public function getAll() : Collection
    {
        return $this->resourceRepository->all();
    }

    /**
     * Get resource by id.
     *
     * @param $id
     * @return ?Model
     */
    public function getById($id) : ?Model
    {
        return $this->resourceRepository->find($id);
    }

    /**
     * Update resource data
     * Store to DB if there are no errors.
     *
     * @param array $data
     * @return Model
     */
    public function updateResource($data, $id) : ?Model
    {
        $model = $this->resourceRepository->find($id);
        if(!$model){
            throw new ModelNotFoundException('Unable to find resource data');
        }
        return $this->saveResource($data, $model);
    }

    /**
     * Validate resource data.
     * Store to DB if there are no errors.
     *
     * @param array $data
     * @return Model
     */
    public function saveResourceData($data) : ?Model
    {
        return $this->saveResource($data, new ResourceItem());
    }

    private function saveResource($data, $resourceItem){

        $resourceItem['title'] = $data['itemTitle'];
        $resourceItem['resourcetype'] = $data['resourceType'];

        switch ($resourceItem['resourcetype']){
            case ResourceTypes::SNIPPET:
                $resourceItem['htmlsnippet'] = $data['htmlsnippet'];
                $resourceItem['description'] = $data['description'];
                break;
            case ResourceTypes::PDF:
                if(key_exists('pdf',$data) && $data['pdf'])
                    $resourceItem['filePath'] = $this->saveFile($data['pdf']);
                break;
            case ResourceTypes::URL:
                $resourceItem['url'] = $data['url'];
               $resourceItem['openinnewtab'] = $data['newtab'] == 'true';
                break;
        }
        DB::beginTransaction();
        $response = null;
        try {
            $response = $this->resourceRepository->save($resourceItem);
        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());

            throw new InvalidArgumentException('Unable to update resource data');
        }

        DB::commit();

        return $response;
    }

    private function saveFile($pdf){
        if($pdf){
            $fileName = time().'_'.$pdf->getClientOriginalName();
            $filePath = $pdf->storeAs('uploads', $fileName, 'public');
            return $filePath;
        }
        return null;
    }
}
