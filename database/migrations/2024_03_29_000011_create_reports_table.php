<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportsTable extends Migration
{
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('report_date');
            $table->string('report_number');
            $table->date('date_of_occurance');
            $table->string('full_name');
            $table->time('time')->nullable();
            $table->string('location');
            $table->longText('narrative');
            $table->string('report_status');
            $table->string('release');
            $table->string('admin_signature');
            $table->date('date_approved')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
