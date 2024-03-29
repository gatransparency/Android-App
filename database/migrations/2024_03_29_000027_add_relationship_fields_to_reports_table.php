<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToReportsTable extends Migration
{
    public function up()
    {
        Schema::table('reports', function (Blueprint $table) {
            $table->unsignedBigInteger('agency_id')->nullable();
            $table->foreign('agency_id', 'agency_fk_9644363')->references('id')->on('agencies_offices');
            $table->unsignedBigInteger('official_number_id')->nullable();
            $table->foreign('official_number_id', 'official_number_fk_9644374')->references('id')->on('public_officials');
        });
    }
}
