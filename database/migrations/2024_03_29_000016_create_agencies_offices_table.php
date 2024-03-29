<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgenciesOfficesTable extends Migration
{
    public function up()
    {
        Schema::create('agencies_offices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('agency_name');
            $table->string('street_address');
            $table->string('street_address_additional')->nullable();
            $table->string('city');
            $table->string('state');
            $table->string('zip');
            $table->string('website_url')->nullable();
            $table->string('phone_number');
            $table->string('agency_email')->nullable();
            $table->string('fax')->nullable();
            $table->string('agency_rating')->nullable();
            $table->longText('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
