<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChangeLogsTable extends Migration
{
    public function up()
    {
        Schema::create('change_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('change');
            $table->longText('log');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
