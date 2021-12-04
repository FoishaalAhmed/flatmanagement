<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFlatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('building_id')->constrained()->onDelete('cascade');
            $table->foreignId('floor_id')->constrained()->onDelete('cascade');
            $table->string('name', 50);
            $table->integer('area');
            $table->tinyInteger('room');
            $table->tinyInteger('washroom');
            $table->tinyInteger('kitchen');
            $table->tinyInteger('balcony');
            $table->string('drawing_dining', 100);
            $table->mediumText('description')->nullable();
            $table->string('photo')->nullable();
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
        Schema::dropIfExists('flats');
    }
}
