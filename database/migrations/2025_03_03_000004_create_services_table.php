<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('service_types', function (Blueprint $table) {
            $table->id();

            $table->string('name', 255);

            $table->timestamps();
        });

        Schema::create('services', function (Blueprint $table) {
           $table->id();

           $table->bigInteger('type_id')->unsigned()->index();
           $table->date('target_date');
           $table->decimal('price', 10, 2)->unsigned();

           $table->foreign('type_id')->references('id')->on('service_types');

           $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->dropForeign(['type_id']);
        });

        Schema::dropIfExists('service_types');
        Schema::dropIfExists('services');
    }
};
