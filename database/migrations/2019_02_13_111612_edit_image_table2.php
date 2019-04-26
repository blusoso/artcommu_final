<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditImageTable2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('images', function (Blueprint $table) {
        $table->dropColumn('description');
        $table->dropColumn('user_id');
        $table->integer('collection_id')->nullable()->change();
        $table->integer('post_id')->nullable();
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('images', function (Blueprint $table) {
        $table->string('description');
        $table->integer('user_id');
        $table->integer('collection_id')->change();
        $table->dropColumn('post_id');
      });
    }
}
