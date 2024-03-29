<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToVehiclesTable extends Migration
{
    public function up()
    {
        Schema::table('vehicles', function (Blueprint $table) {
            $table->unsignedBigInteger('gtnn_number_id')->nullable();
            $table->foreign('gtnn_number_id', 'gtnn_number_fk_9232849')->references('id')->on('public_officials');
            $table->unsignedBigInteger('agency_vehicle_id')->nullable();
            $table->foreign('agency_vehicle_id', 'agency_vehicle_fk_9242206')->references('id')->on('agencies_offices');
        });
    }
}
