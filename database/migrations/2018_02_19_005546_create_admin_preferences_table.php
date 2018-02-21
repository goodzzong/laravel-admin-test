<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminPreferencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_preferences', function (Blueprint $table) {
            $table->increments('id');
            $table->string('menu','20');
            $table->enum('autoChange', ['1', '2'])->defalut(1);
            $table->float('changeTime','3','1');
            $table->integer('output');
            $table->char('pageButton','1');
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
        Schema::dropIfExists('admin_preferences');
    }
}
