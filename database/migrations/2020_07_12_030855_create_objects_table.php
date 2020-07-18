<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('objects', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id')->nullable()->unsigned();
            $table->foreign('parent_id')->references('id')->on('objects');
            $table->string('object_code', 50)->unique();
            $table->string('object_url', 500);
            $table->string('object_name', 100)->unique();
            $table->string('menu_name', 100)->unique();
            $table->string('description', 500)->nullable();
            $table->integer('object_level');
            $table->boolean('status')->default(true);
            $table->boolean('show_menu')->default(true);
            $table->string('created_by', 50)->nullable();
            $table->string('updated_by', 50)->nullable();
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
        Schema::dropIfExists('objects');
    }
}
