<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('building_id')->constrained()->onDelete('cascade');
            $table->foreignId('floor_id')->constrained()->onDelete('cascade');
            $table->foreignId('flat_id')->constrained()->onDelete('cascade');
            $table->foreignId('tenant_id')->constrained()->onDelete('cascade');
            $table->string('invoice', 10);
            $table->date('date');
            $table->integer('rent');
            $table->string('month', 15);
            $table->integer('year');
            $table->integer('water_bill');
            $table->integer('gas_bill');
            $table->integer('electricity_bill');
            $table->integer('security_bill');
            $table->integer('utility_bill');
            $table->integer('service_bill');
            $table->integer('other_bill');
            $table->integer('total_rent');
            $table->integer('paid');
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
        Schema::dropIfExists('rents');
    }
}
