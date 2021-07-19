<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('client_id')->constrained()->onDelete('cascade');
            $table->foreignId('service_id')->constrained()->onDelete('cascade');
            $table->foreignId('payment_type_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('account_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('invoice_id')->nullable()->constrained()->onDelete('set null');     
            $table->date('date');  
            $table->date('cutoff_date');       
            $table->double('monto');
            $table->text('concept');
            $table->text('note')->nullable();
            $table->boolean('send_email')->nullable()->default(0);
            $table->enum('proof', ['Nota simple', 'Voucher', 'Factura'])->nullable();
            $table->string('simple_note_url')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
