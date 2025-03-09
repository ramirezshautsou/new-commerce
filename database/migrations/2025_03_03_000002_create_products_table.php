<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('producers', function (Blueprint $table) {
            $table->id();

            $table->string('name', 255);
            $table->string('alias', 255)->unique();

            $table->timestamps();
        });

        Schema::create('products', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('category_id')->unsigned()->index();
            $table->string('name', 255);
            $table->string('alias', 255)->unique();
            $table->text('description')->nullable();
            $table->bigInteger('producer_id')->unsigned()->index();
            $table->date('production_date')->nullable();
            $table->decimal('price', 10, 2)->unsigned()->nullable();

            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('producer_id')->references('id')->on('producers');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
            $table->dropForeign(['producer_id']);
        });

        Schema::dropIfExists('products');
        Schema::dropIfExists('producers');
    }
};
