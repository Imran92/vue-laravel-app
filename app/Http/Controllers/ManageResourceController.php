<?php

namespace App\Http\Controllers;

use App\Contracts\Services\ResourceServiceInterface;
use App\Models\ResourceItem;
use App\Contracts\Repositories\ResourceRepositoryInterface;
use Illuminate\Http\Request;

class ManageResourceController extends Controller
{
    private $resourceService;

    public function __construct(ResourceServiceInterface $resourceService)
    {
        $this->resourceService = $resourceService;
    }

    public function store(Request $request)
    {
        $isEdit = $request->id??false;
        $this->validate($request,$this->resourceService->getValidationArray($request->input('resourceType'), $isEdit));
        if($isEdit){
            $this->resourceService->updateResource($request->all(), $request->id);
        } else {
            $this->resourceService->saveResourceData($request->all());
        }

        return response()->json('resource created!');
    }

    public function update($id, Request $request)
    {
        $this->validate($request,$this->resourceService->getValidationArray($request->input('resourceType'), true));
        $this->resourceService->updateResource($request->all(), $id);

        return response()->json('component updated!');
    }

    public function destroy($id)
    {
        $this->resourceService->deleteById($id);

        return response()->json('component deleted!');
    }
}
