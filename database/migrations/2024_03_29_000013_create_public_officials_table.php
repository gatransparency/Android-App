<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePublicOfficialsTable extends Migration
{
    public function up()
    {
        Schema::create('public_officials', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('gtnn_number')->unique();
            $table->string('name');
            $table->string('email')->nullable();
            $table->date('hired')->nullable();
            $table->string('badge_number')->nullable();
            $table->string('rank_position');
            $table->decimal('hourly_rate', 15, 2)->nullable();
            $table->decimal('annual_salary', 15, 2)->nullable();
            $table->string('status')->nullable();
            $table->string('okey_number')->nullable();
            $table->string('years')->nullable();
            $table->string('phone_number')->nullable();
            $table->longText('previous_employment')->nullable();
            $table->string('professionalism')->nullable();
            $table->string('appearance')->nullable();
            $table->string('uniform')->nullable();
            $table->string('attitude')->nullable();
            $table->string('law_knowledge')->nullable();
            $table->string('rights_violations')->nullable();
            $table->longText('if_yes')->nullable();
            $table->longText('notes')->nullable();
            $table->string('signature');
            $table->string('initials');
            $table->timestamps();
        });
    }
}
