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
            $table->string('docnum');
            $table->string('numbercar');
            $table->string('numbertrailer');
            $table->dateTime('arrivaldate');
            $table->string('notesguard');
            $table->dateTime('closingdatedelivery');
            $table->string('locationcar');
            $table->string('numberdt');
            $table->dateTime('inningsdt');
            $table->dateTime('releasedt');
            $table->string('specialistinformation');
            $table->string('fitovetcontrol');
            $table->dateTime('dateappointmentinspection');
            $table->dateTime('enddateinspectionfact');
            $table->dateTime('datedeparture');
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
