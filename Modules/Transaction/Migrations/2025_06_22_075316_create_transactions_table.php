<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('sale_id');
            $table->unsignedBigInteger('item_id');

            $table->integer('qty');
            $table->integer('harga');
            $table->integer('subtotal');

            $table->timestamps();

            $table->foreign('sale_id')
                  ->references('id')->on('sales')
                  ->onDelete('cascade');

            $table->foreign('item_id')
                  ->references('id')->on('items')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
