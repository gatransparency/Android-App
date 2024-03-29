<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCaseLawsTable extends Migration
{
    public function up()
    {
        Schema::create('case_laws', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('docket_number');
            $table->string('court');
            $table->string('case');
            $table->date('decided');
            $table->longText('case_narrative');
            $table->string('judge');
            $table->string('added_by');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
