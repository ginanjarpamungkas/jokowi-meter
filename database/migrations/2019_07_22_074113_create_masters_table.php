<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMastersTable extends Migration{
    public function up(){
        Schema::create('masters', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama');
            $table->string('keterangan');
            $table->timestamps();
        });
    }

    public function down(){
        Schema::dropIfExists('masters');
    }
}
