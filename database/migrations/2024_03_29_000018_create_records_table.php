<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecordsTable extends Migration
{
    public function up()
    {
        Schema::create('records', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('date_added');
            $table->string('full_name');
            $table->string('record_type');
            $table->string('entered_by');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
