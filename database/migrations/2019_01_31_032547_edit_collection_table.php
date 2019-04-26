<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditCollectionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('collections', function (Blueprint $table) {
        $table->string('description')->nullable()->change();
        $table->integer('user_id')->nullable()->change();
        $table->dropColumn('collection_created_at');
        $table->boolean('is_private');
        $table->softDeletes();
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
        $table->string('description')->change();
        $table->integer('user_id')->change();
        $table->dateTime('collection_created_at');
        $table->dropColumn('is_private');
        $table->dropColumn('deleted_at');
      });

    }
}
