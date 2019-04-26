<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditUserTable3 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('users', function (Blueprint $table) {
        $table->integer('is_admin')->default(0)->change();
        $table->string('bio')->nullable()->change();
        $table->integer('followed_count')->default(0)->change();
        $table->integer('following_count')->default(0)->change();
        $table->integer('fav_count')->default(0)->change();
        $table->integer('collection_id')->nullable()->change();
        $table->integer('fav_count')->nullable()->change();
        $table->string('bio_link');
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
        $table->string('bio')->change();
        $table->integer('followed_count')->change();
        $table->integer('following_count')->change();
        $table->integer('collection_id')->change();
        $table->integer('fav_count')->change();
        $table->dropColumn('bio_link');
      });
    }
}
