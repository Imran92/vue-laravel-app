<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ResourceFeatureTest extends TestCase
{
    public function testUpdatingEmptyData()
    {
        $resp = $this->json('POST', 'api/resources', [])
            ->assertStatus(422)
            ->assertJson([
            "message" => "The given data was invalid.",
            "errors" => [
                "itemTitle" => ["The item title field is required."],
            ]
        ]);
    }
    public function testUpdatingProperData()
    {

        $resourceData = [
            "itemTitle" => "Tst",
            "resourceType" => "snippet",
            "htmlsnippet" => "test snippet"
        ];
        $resp = $this->json('POST', 'api/resources', $resourceData)
            ->assertStatus(422);

        $resourceData["description"] = "test desc";
        $resp = $this->json('POST', 'api/resources', $resourceData)
            ->assertStatus(200);
    }
}
