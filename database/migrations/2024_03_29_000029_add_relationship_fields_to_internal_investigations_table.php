<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToInternalInvestigationsTable extends Migration
{
    public function up()
    {
        Schema::table('internal_investigations', function (Blueprint $table) {
            $table->unsignedBigInteger('gtnn_number_id')->nullable();
            $table->foreign('gtnn_number_id', 'gtnn_number_fk_9232863')->references('id')->on('public_officials');
            $table->unsignedBigInteger('agency_office_id')->nullable();
            $table->foreign('agency_office_id', 'agency_office_fk_9233003')->references('id')->on('agencies_offices');
        });
    }
}
