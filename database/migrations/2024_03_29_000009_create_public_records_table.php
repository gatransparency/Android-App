<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePublicRecordsTable extends Migration
{
    public function up()
    {
        Schema::create('public_records', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('request_number')->unique();
            $table->string('agency');
            $table->date('response_due');
            $table->string('county');
            $table->string('state');
            $table->longText('records_requested');
            $table->string('status');
            $table->decimal('estimated_amount', 15, 2)->nullable();
            $table->decimal('amount_paid', 15, 2)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
