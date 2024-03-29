<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePortalRequestsTable extends Migration
{
    public function up()
    {
        Schema::create('portal_requests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email');
            $table->longText('request');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
