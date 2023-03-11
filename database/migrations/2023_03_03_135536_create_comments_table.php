<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->text('text');
            $table->bigInteger('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users_comments')->onDelete('cascade');
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
        Schema::table('comments', function (Blueprint $table)
        {
            $table->dropForeign('comments_user_id_foreign');
            $table->dropColumn('user_id');
        });
        Schema::dropIfExists('comments');
    }
};
