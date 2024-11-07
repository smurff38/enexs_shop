<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id('id_product');
            $table->string('name_product', 100);
            $table->text('description')->nullable();
            $table->binary('picture')->nullable();
            $table->decimal('price', 10, 2);
            $table->integer('kol');
            $table->unsignedBigInteger('id_category')->nullable();
            $table->foreign('id_category')->references('id_category')->on('categories')->onDelete('set null');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
}
