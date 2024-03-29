<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToPublicOfficialDatasTable extends Migration
{
    public function up()
    {
        Schema::table('public_official_datas', function (Blueprint $table) {
            $table->unsignedBigInteger('current_agency_id')->nullable();
            $table->foreign('current_agency_id', 'current_agency_fk_9642439')->references('id')->on('agencies_offices');
        });
    }
}
