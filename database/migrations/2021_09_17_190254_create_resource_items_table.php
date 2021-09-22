<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use \App\Constants\ResourceTypes;

class CreateResourceItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resource_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->enum('resourcetype', [ResourceTypes::PDF, ResourceTypes::SNIPPET, ResourceTypes::URL]);
            $table->string('filepath')->nullable();
            $table->text('description')->nullable();
            $table->text('htmlsnippet')->nullable();
            $table->boolean('openinnewtab')->nullable();
            $table->string('url')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('resource_items');
    }
}
