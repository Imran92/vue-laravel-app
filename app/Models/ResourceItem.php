<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResourceItem extends Model
{

    protected $fillable = [
        'title',
        'resourceType',
        'filepath',
        'description',
        'htmlsnippet',
        'openinnewtab',
        'url'
    ];
}
