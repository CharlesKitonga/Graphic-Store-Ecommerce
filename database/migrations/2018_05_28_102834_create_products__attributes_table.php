<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products__attributes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id');
            $table->string('category_name');
            $table->string('designs');
            $table->string('designers');
            $table->string('revisions');
            $table->string('guarantee');
            $table->float('price');
            $table->float('image');
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
        Schema::dropIfExists('products__attributes');
    }
}
