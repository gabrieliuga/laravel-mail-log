<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMailLogTables extends Migration
{
    public function up()
    {
        Schema::create('mail_log', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('to')->nullable();
            $table->text('cc')->nullable();
            $table->text('bcc')->nullable();
            $table->text('subject')->nullable();
            $table->text('message')->nullable();
            $table->json('data')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('mail_log');
    }
}
