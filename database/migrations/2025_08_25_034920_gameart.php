<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('tb_gameart_list', function (Blueprint $table) {
            $table->id();
            $table->string('gameName', 50)->nullable();
            $table->integer('gameId')->nullable();
            $table->string('thumbnail', 300)->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void {
        Schema::dropIfExists('tb_gameart_list');
    }
};
