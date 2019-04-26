<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('users', function (Blueprint $table) {
        $table->renameColumn('name','username');
        $table->string('avatar', 255);
        $table->string('display_name', 255);
        $table->string('bio', 255);
        $table->string('is_admin', 255);
        $table->string('followed_count', 255);
        $table->string('following_count', 255);
        $table->integer('fav_count');
        $table->integer('collection_id');
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
        $table->renameColumn('username','name');
        $table->dropColumn('avatar');
        $table->dropColumn('display_name');
        $table->dropColumn('bio');
        $table->dropColumn('is_admin');
        $table->dropColumn('followed_count');
        $table->dropColumn('following_count');
        $table->dropColumn('collection_id');
      });
    }
}
