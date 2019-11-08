<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableArtikels extends Migration{
    public function up(){
        Schema::create('artikels', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('judul');
            $table->string('foto');
            $table->text('isi');
            $table->string('keterangan');
            $table->string('slug');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(){
        Schema::dropIfExists('artikels');
    }
}
