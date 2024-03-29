<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToVehiclesTable extends Migration
{
    public function up()
    {
        Schema::table('vehicles', function (Blueprint $table) {
            $table->unsignedBigInteger('agency_id')->nullable();
            $table->foreign('agency_id', 'agency_fk_9644420')->references('id')->on('agencies_offices');
            $table->unsignedBigInteger('public_official_id')->nullable();
            $table->foreign('public_official_id', 'public_official_fk_9644421')->references('id')->on('public_officials');
        });
    }
}
