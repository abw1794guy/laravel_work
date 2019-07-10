<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->index()->comment('名稱');
            $table->text('description')->nullable()->comment('內容');
            $table->integer('post_count')->default(0)->comment('文章數');
        });
    }

    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
