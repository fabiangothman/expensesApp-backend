<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->boolean('canceled')->default(0);
            $table->unsignedBigInteger('expense_id')->unsigned();
            $table->string('description', 255)->nullable()->default(null);
            $table->timestamps();

            $table->foreign('expense_id')
                ->references('id')->on('expenses')
                ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
