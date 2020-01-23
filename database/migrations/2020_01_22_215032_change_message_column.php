<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeMessageColumn extends Migration
{
    public function up()
    {
        Schema::table('mail_log', function (Blueprint $table) {
            $table->longText('message')->change();
        });
    }

    public function down()
    {
        Schema::table('mail_log', function (Blueprint $table) {
            $table->text('message')->change();
        });
    }
}
