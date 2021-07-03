<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProspectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prospects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->string('name');
            $table->string('interest');
            $table->string('status')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('origin')->nullable();
            $table->string('company')->nullable();
            //Quotation
            $table->boolean('has_quotation')->nullable()->default(0);
            $table->double('quotation_total')->nullable();
            $table->date('quotation_start_date')->nullable();
            $table->date('quotation_due_date')->nullable();
            $table->string('quotation_url')->nullable();
            $table->text('quotation_concept')->nullable();
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
        Schema::dropIfExists('prospects');
    }
}
