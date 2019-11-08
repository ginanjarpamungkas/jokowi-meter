<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDetailPromises extends Migration{
    public function up(){
        Schema::create('detail_promises', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('promise_id');
            $table->text('deskripsi');
            $table->string('status');
            $table->string('keterangan');
            $table->timestamps();
        });
    }

    public function down(){
        Schema::dropIfExists('detail_promises');
    }
}
