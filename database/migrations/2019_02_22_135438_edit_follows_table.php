<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditFollowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('follows', function (Blueprint $table) {
          $table->dropColumn('user_id');
          $table->renameColumn('follower_id', 'owner_id');
          $table->renameColumn('followed_id', 'following_id');
          $table->boolean('is_follow')->default(1);
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('follows', function (Blueprint $table) {
          $table->integer('user_id');
          $table->renameColumn('owner_id', 'follower_id');
          $table->renameColumn('following_id', 'followed_id');
          $table->dropColumn('is_follow');
      });
    }
}
