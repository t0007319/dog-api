<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBreedablesTable extends Migration
{
    public function up(): void
    {
        Schema::create('breedables', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('breed_id');
            $table->string('breedable_type');
            $table->unsignedBigInteger('breedable_id');
            $table->timestamps();

            $table->foreign('breed_id')->references('id')->on('breeds')->onDelete('cascade');
        });
    }
}
