<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditUsersTable2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('users', function (Blueprint $table) {
        $table->integer('fav_count');
        $table->integer('following_count')->change();
        $table->integer('followed_count')->change();
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('users', function (Blueprint $table) {
        $table->dropColumn('fav_count');
        $table->string('following_count', 255)->change();
        $table->string('followed_count', 255)->change();
      });
    }
}
