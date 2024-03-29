<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubmitRecordsTable extends Migration
{
    public function up()
    {
        Schema::create('submit_records', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('role');
            $table->string('name');
            $table->string('agency_affiliation');
            $table->string('address');
            $table->longText('narrative');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
