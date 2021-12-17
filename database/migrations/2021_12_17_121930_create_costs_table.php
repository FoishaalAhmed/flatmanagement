<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('costs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('building_id')->constrained()->onDelete('cascade');
            $table->foreignId('floor_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('flat_id')->nullable()->constrained()->onDelete('cascade');
            $table->date('date');
            $table->string('type', 10);
            $table->string('cause');
            $table->integer('amount');
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
        Schema::dropIfExists('costs');
    }
}
