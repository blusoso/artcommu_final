<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditPostTable2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('posts', function (Blueprint $table) {
        $table->integer('collection_id')->nullable()->change();
        $table->dropColumn('img_id');
        $table->integer('fav_id')->nullable()->change();
        $table->string('img');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('posts', function (Blueprint $table) {
        $table->integer('collection_id')->change();
        $table->integer('img_id');
        $table->integer('fav_id')->change();
        $table->dropColumn('img');
      });
    }
}
