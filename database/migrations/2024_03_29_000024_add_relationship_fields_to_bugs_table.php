<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToBugsTable extends Migration
{
    public function up()
    {
        Schema::table('bugs', function (Blueprint $table) {
            $table->unsignedBigInteger('version_id')->nullable();
            $table->foreign('version_id', 'version_fk_9244825')->references('id')->on('portal_versions');
        });
    }
}
