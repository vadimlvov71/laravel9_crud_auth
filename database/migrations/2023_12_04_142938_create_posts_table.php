<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
			$table->string('title');
			$table->text('content');
            $table->timestamps();
            $table->integer('user_id')->index();
            $table->foreign('user_id')->references('id')->on('users')
            //->onDelete('cascade')
            ;
        });
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //$table->dropForeign('lists_user_id_foreign');
       // $table->dropIndex('lists_user_id_index');
       // $table->dropColumn('user_id');
        Schema::dropIfExists('posts');
    }
}
