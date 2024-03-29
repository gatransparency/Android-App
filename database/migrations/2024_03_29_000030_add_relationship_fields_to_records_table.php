<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToRecordsTable extends Migration
{
    public function up()
    {
        Schema::table('records', function (Blueprint $table) {
            $table->unsignedBigInteger('gtnn_number_id')->nullable();
            $table->foreign('gtnn_number_id', 'gtnn_number_fk_9232873')->references('id')->on('public_officials');
            $table->unsignedBigInteger('agency_id')->nullable();
            $table->foreign('agency_id', 'agency_fk_9242282')->references('id')->on('agencies_offices');
        });
    }
}
