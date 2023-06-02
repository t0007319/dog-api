<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubBreedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('sub_breeds', static function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('breed_id');
            $table->timestamps();

            $table->foreign('breed_id')->references('id')->on('breeds')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sub_breeds');
    }
}
