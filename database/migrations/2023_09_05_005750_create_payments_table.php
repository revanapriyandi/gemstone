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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('payment_code')->unique();
            $table->foreignId('transaksi_id')->constrained('transaksis')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('metode_pembayaran_id')->constrained('metode_pembayarans')->onDelete('cascade')->onUpdate('cascade');
            $table->string('order_id');
            $table->enum('status', ['pending', 'success', 'failed', 'expire', 'cancel', 'refund', 'settlement', 'capture', 'deny'])->default('pending');
            $table->string('payment_status_message')->nullable();
            $table->string('payment_status_code')->nullable();
            $table->string('payment_transaction_id')->nullable();
            $table->string('payment_type')->nullable();
            $table->string('payment_option_type')->nullable();
            $table->string('payment_amount')->nullable();
            $table->string('payment_currency')->nullable();
            $table->timestamp('payment_transaction_time')->nullable();
            $table->string('payment_bank')->nullable();
            $table->string('payment_va_number')->nullable();
            $table->string('merchant_id')->nullable();
            $table->string('fraud_status')->nullable();
            $table->string('signature_key')->nullable();
            $table->string('reference_id')->nullable();
            $table->string('shopeepay_reference_number')->nullable();
            $table->string('acquirer')->nullable();
            $table->string('issuer')->nullable();
            $table->string('approval_code')->nullable();
            $table->string('masked_card')->nullable();
            $table->string('channel_response_code')->nullable();
            $table->string('channel_response_message')->nullable();
            $table->string('card_type')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
