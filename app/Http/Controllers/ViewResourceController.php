<?php

namespace App\Http\Controllers;

use App\Contracts\Services\ResourceServiceInterface;
use App\Models\ResourceItem;
use App\Contracts\Repositories\ResourceRepositoryInterface;
use Illuminate\Http\Request;

class ViewResourceController extends Controller
{
    private $resourceService;

    public function __construct(ResourceServiceInterface $resourceService)
    {
        $this->resourceService = $resourceService;
    }
    public function index()
    {
        return $this->resourceService->getAll();
    }

    public function show($id)
    {
        $resourceItem = ResourceItem::find($id);
        return response()->json($resourceItem);
    }
}
