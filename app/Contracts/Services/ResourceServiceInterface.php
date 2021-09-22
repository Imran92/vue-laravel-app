<?php

namespace App\Contracts\Services;

use App\Models\ResourceItem;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;

interface ResourceServiceInterface
{
    function getValidationArray($type, $isEdit = false) : array;
    function deleteById($id) : int;
    function getAll() : Collection;
    function getById($id) : ?Model;
    function updateResource($data, $id) : ?Model;
    function saveResourceData($data) : ?Model;
}
