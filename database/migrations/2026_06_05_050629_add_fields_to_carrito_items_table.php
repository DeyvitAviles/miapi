<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('carrito_items', function (Blueprint $table) {

            $table->foreignId('user_id')
                ->constrained()
                ->onDelete('cascade');

            $table->foreignId('producto_id')
                ->constrained()
                ->onDelete('cascade');

            $table->integer('cantidad')
                ->default(1);
        });
    }

    public function down(): void
    {
        Schema::table('carrito_items', function (Blueprint $table) {

            $table->dropForeign(['user_id']);
            $table->dropForeign(['producto_id']);

            $table->dropColumn([
                'user_id',
                'producto_id',
                'cantidad'
            ]);
        });
    }
};