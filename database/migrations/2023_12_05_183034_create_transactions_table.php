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
            $table->unsignedBigInteger('scheduledexpense_id')->nullable();
            $table->unsignedBigInteger('expense_id')->nullable();
            $table->boolean('canceled')->default(0);
            $table->string('description')->nullable();
            $table->timestamps();

            $table->foreign('scheduledexpense_id')
                ->references('id')->on('scheduled_expenses')
                ->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('expense_id')
                ->references('id')->on('expenses')
                ->onUpdate('cascade')->onDelete('restrict');
            
            // $table->check('((foreign_key1 IS NOT NULL AND foreign_key2 IS NULL) OR (foreign_key1 IS NULL AND foreign_key2 IS NOT NULL))');
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
