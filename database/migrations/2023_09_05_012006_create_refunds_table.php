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
        Schema::create('refunds', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transaksi_id')->constrained('transaksis')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('payment_id')->constrained('payments')->onDelete('cascade')->onUpdate('cascade');
            $table->string('transaction_id')->nullable();
            $table->string('refund_key')->nullable();
            $table->string('refund_amount')->nullable();
            $table->string('refund_reason')->nullable();
            $table->string('refund_method')->nullable();
            $table->string('bank_confirmed_at')->nullable();
            $table->string('refund_chargeback_id');
            $table->string('order_id')->nullable();
            $table->enum('transaction_status', ['refund', 'partial_refund', 'failed', 'pending']);
            $table->datetime('transaction_time')->nullable();
            $table->string('status_message')->nullable();
            $table->string('status_code')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('refunds');
    }
};
