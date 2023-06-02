<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParkablesTable extends Migration
{
    public function up(): void
    {
        Schema::create('parkables', static function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('park_id');
            $table->unsignedBigInteger('parkable_id');
            $table->string('parkable_type');
            $table->string('location');
            $table->string('name');
            $table->timestamps();

            $table->foreign('park_id')->references('id')->on('parks')->onDelete('cascade');
        });
    }
}
