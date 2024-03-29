<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportbugsTable extends Migration
{
    public function up()
    {
        Schema::create('reportbugs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email');
            $table->longText('synopsis');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
