<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToPublicOfficialsTable extends Migration
{
    public function up()
    {
        Schema::table('public_officials', function (Blueprint $table) {
            $table->unsignedBigInteger('agency_id')->nullable();
            $table->foreign('agency_id', 'agency_fk_9644470')->references('id')->on('agencies_offices');
        });
    }
}
