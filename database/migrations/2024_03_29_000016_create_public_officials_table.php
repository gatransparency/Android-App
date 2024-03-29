<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePublicOfficialsTable extends Migration
{
    public function up()
    {
        Schema::create('public_officials', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('public_official_number')->unique();
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->string('badge_employee_number')->nullable();
            $table->string('sex')->nullable();
            $table->string('rank')->nullable();
            $table->string('status')->nullable();
            $table->string('officer_key_number')->nullable();
            $table->date('hired')->nullable();
            $table->string('years_in_profession')->nullable();
            $table->string('email')->nullable();
            $table->string('phone_number')->nullable();
            $table->longText('previous_agency')->nullable();
            $table->longText('notes')->nullable();
            $table->string('accuracy');
            $table->string('signature');
            $table->string('initials');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
