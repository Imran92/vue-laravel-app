<?php

namespace Tests\Unit;

use App\Models\ResourceItem;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ResourceModelTest extends TestCase
{
    use RefreshDatabase;

    public function testSimpleDbEntry()
    {
        $item = new ResourceItem();
        $item->title = "test";
        $item->resourceType = "snippet";
        $item->description = "test desc";
        $item->htmlsnippet = "test snippet";
        $resp = $item->save();
        $this->assertTrue($resp);
        $this->assertTrue(ResourceItem::count() == 1);
    }
    //negative case
    public function testIntegrityViolatingWithoutResourceType()
    {
        $this->assertException(QueryException::class, function() {
            $item = new ResourceItem();
            $item->title = "test";
            $item->description = "test desc";
            $item->htmlsnippet = "test snippet";
            $item->save();
        });
    }
    //negative case
    public function testIntegrityViolatingWithoutTitle()
    {
        $this->assertException(QueryException::class, function() {
            $item = new ResourceItem();
            $item->resourceType = "snippet";
            $item->description = "test desc";
            $item->htmlsnippet = "test snippet";
            $item->save();
        });
    }
}
