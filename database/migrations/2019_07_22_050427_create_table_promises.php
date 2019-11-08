<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePromises extends Migration{
    public function up(){
        Schema::create('promises', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('judul');
            $table->string('topik');
            $table->string('status');
            $table->string('periode');
            $table->string('slug');
            $table->text('tags');
            $table->string('keterangan');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(){
        Schema::dropIfExists('promises');
    }
}
