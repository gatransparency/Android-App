<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToInternalInvestigationsTable extends Migration
{
    public function up()
    {
        Schema::table('internal_investigations', function (Blueprint $table) {
            $table->unsignedBigInteger('agency_id')->nullable();
            $table->foreign('agency_id', 'agency_fk_9644607')->references('id')->on('agencies_offices');
            $table->unsignedBigInteger('public_official_id')->nullable();
            $table->foreign('public_official_id', 'public_official_fk_9644608')->references('id')->on('public_officials');
            $table->unsignedBigInteger('entered_by_id')->nullable();
            $table->foreign('entered_by_id', 'entered_by_fk_9644612')->references('id')->on('users');
        });
    }
}
