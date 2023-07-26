<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('img_url')->nullable();
            $table->unsignedInteger('age')->nullable();
            $table->unsignedBigInteger('position_id')->nullable();
            $table->string('phone')->nullable();
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('img_url');
            $table->dropColumn('age');
            $table->dropColumn('position_id');
            $table->dropColumn('phone');
        });
    }
}
