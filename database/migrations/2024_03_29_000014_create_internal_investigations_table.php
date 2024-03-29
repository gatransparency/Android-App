<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInternalInvestigationsTable extends Migration
{
    public function up()
    {
        Schema::create('internal_investigations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('ia_date');
            $table->string('name');
            $table->string('investigator');
            $table->longText('narrative');
            $table->string('entered_by');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
