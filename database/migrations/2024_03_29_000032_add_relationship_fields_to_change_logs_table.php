<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToChangeLogsTable extends Migration
{
    public function up()
    {
        Schema::table('change_logs', function (Blueprint $table) {
            $table->unsignedBigInteger('portal_version_id')->nullable();
            $table->foreign('portal_version_id', 'portal_version_fk_9291386')->references('id')->on('portal_versions');
        });
    }
}
