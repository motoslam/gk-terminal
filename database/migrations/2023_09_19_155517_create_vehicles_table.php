<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id');
            $table->string('docnum')->unique();
            $table->string('numbercar')->nullable();
            $table->string('numbertrailer')->nullable();
            $table->dateTime('arrivaldate')->nullable();
            $table->string('notesguard')->nullable();
            $table->dateTime('closingdatedelivery')->nullable();
            $table->string('locationcar');
            $table->string('numberdt')->nullable();
            $table->dateTime('inningsdt')->nullable();
            $table->dateTime('releasedt')->nullable();
            $table->string('specialistinformation')->nullable();
            $table->string('fitovetcontrol')->nullable();
            $table->dateTime('dateappointmentinspection')->nullable();
            $table->dateTime('enddateinspectionfact')->nullable();
            $table->dateTime('datedeparture')->nullable();
            $table->string('target');
            $table->softDeletes();
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
        Schema::dropIfExists('vehicles');
    }
}
