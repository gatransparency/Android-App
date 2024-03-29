<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToPublicOfficialsTable extends Migration
{
    public function up()
    {
        Schema::table('public_officials', function (Blueprint $table) {
            $table->unsignedBigInteger('current_agency_id')->nullable();
            $table->foreign('current_agency_id', 'current_agency_fk_9233002')->references('id')->on('agencies_offices');
        });
    }
}
