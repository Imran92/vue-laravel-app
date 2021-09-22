<?php

namespace App\Contracts\Repositories;

use App\Models\ResourceItem;
use Illuminate\Support\Collection;

interface ResourceRepositoryInterface
{
    public function all(): Collection;
}
