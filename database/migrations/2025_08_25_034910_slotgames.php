<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('tb_slot_games_list', function (Blueprint $table) {
            $table->id();
            $table->string('gameName', 50);
            $table->integer('gameNumber');
            $table->string('gameCategory', 50)->default('Html5');
            $table->string('currencyCode', 5)->default('EUR');
            $table->integer('windowHeight')->default(500);
            $table->integer('windowWidth')->default(500);
            $table->text('gameImageLocations')->nullable();
            $table->decimal('gamePrice', 10, 2)->default(0.00);
            $table->text('gameDescription')->nullable();
            $table->text('background')->nullable();
            $table->boolean('published')->default(true);
            $table->string('merchant_code', 20)->default(' ');
            $table->text('prizeSchemeIge')->nullable();
            $table->text('extraParams')->nullable();
            $table->integer('ordering')->default(0);
            $table->text('portal_bg')->nullable();
            $table->enum('engineType', ['IGEASIA','IGEICE','IGEBETA','IGEMS','CT'])->default('CT');

            $table->timestamps();       // created_at, updated_at
            $table->softDeletes();      // deleted_at
        });
    }

    public function down(): void {
        Schema::dropIfExists('tb_slot_games_list');
    }
};
