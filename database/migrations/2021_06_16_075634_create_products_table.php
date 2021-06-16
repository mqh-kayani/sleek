<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('collection_id')->nullable();
            $table->string('name');
            $table->decimal('price',8,1);
            $table->enum('size',['Extra Large','Large','Medium','Small','Extra Small']);
            $table->text('video')->nullable();
            $table->text('description');
            $table->string('color')->nullable();
            $table->boolean('is_available')->default(true)->nullable();
            $table->boolean('is_top')->default(false)->nullable();
            $table->boolean('is_featured')->default(false)->nullable();
            $table->string('slug')->unique()->nullable();
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('categories')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('collection_id')->references('id')->on('collections')
                ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
