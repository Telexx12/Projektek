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
            $table->foreignId('account_id')->index()->constrained()->onDelete('cascade');
            $table->date('started_date');
            $table->date('completed_date')->index();
            $table->text('description')->nullable();
            $table->string('currency')->default('RON');
            $table->double('amount');
            $table->text('comment')->nullable()->index();
            $table->foreignId('user_id')->index()->constrained();
            $table->foreignId('category_id')->index()->nullable();

            $table->timestamps();
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
