<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditCollectionTable2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('collections', function (Blueprint $table) {
        $table->integer('is_favorite')->nullable();
        $table->integer('favorite_count')->nullable();
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('collections', function (Blueprint $table) {
        $table->dropColumn('is_favorite');
        $table->dropColumn('favorite_count');
      });
    }
}
