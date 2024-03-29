<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToReportsTable extends Migration
{
    public function up()
    {
        Schema::table('reports', function (Blueprint $table) {
            $table->unsignedBigInteger('gtnn_number_id')->nullable();
            $table->foreign('gtnn_number_id', 'gtnn_number_fk_9232840')->references('id')->on('public_officials');
            $table->unsignedBigInteger('agency_id')->nullable();
            $table->foreign('agency_id', 'agency_fk_9242283')->references('id')->on('agencies_offices');
        });
    }
}
