<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBugsTable extends Migration
{
    public function up()
    {
        Schema::create('bugs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('status');
            $table->longText('synopsis');
            $table->date('fixed')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
