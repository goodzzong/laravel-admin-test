<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminMediasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_medias', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('title','190');
            $table->string('media','255');
            $table->integer('rank');
            $table->enum('released',['1','2'])->defalut(1);
            $table->index('user_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin_medias');
    }
}
