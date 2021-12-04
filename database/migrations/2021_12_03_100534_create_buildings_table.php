<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBuildingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buildings', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('floor');
            $table->integer('flat');
            $table->boolean('cctv')->default(true);
            $table->boolean('guard')->default(true);
            $table->boolean('parking')->default(true);
            $table->boolean('lift')->default('true');
            $table->string('water', 100);
            $table->string('gas', 100);
            $table->mediumText('address');
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
        Schema::dropIfExists('buildings');
    }
}
