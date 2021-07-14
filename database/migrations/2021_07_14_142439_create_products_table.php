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
            $table->string('sku');
            $table->string('name');
            $table->string('image');
            $table->decimal('cost_price', 8, 2);
            $table->decimal('retail_price', 8, 2);
            $table->unsignedInteger('weight');
            $table->unsignedInteger('quantity');
            $table->unsignedInteger('threshold_quantity');
            $table->string('description');
            $table->date('expiration_date');
            $table->foreignId('category_id')->constrained('categories');
            $table->foreignId('family_id')->constrained('families');
            $table->foreignId('size_id')->constrained('sizes');
            $table->foreignId('color_id')->constrained('colors');
            $table->foreignId('ray_id')->constrained('rays');
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
        Schema::table('products', function (Blueprint $table) {
            $table->dropConstrainedForeign('category_id');
            $table->dropConstrainedForeign('family_id');
            $table->dropConstrainedForeign('size_id');
            $table->dropConstrainedForeign('color_id');
            $table->dropConstrainedForeign('ray_id');
        });
        Schema::dropIfExists('products');
    }
}
