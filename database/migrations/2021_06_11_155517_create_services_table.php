<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_service_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('client_id')->nullable()->constrained()->onDelete('cascade');
            $table->enum('type', ['Proyecto', 'Mensual']);
            $table->string('name');
            $table->date('start_date');
            $table->date('due_date')->nullable(); //Día de vencimiento  para el tipo "Mensual"
            $table->integer('due_day')->nullable();  //Fecha de vencimiento para el tipo "Proyecto"
            $table->double('price');
            $table->text('note')->nullable();
            $table->text('service_agreement')->nullable();
            $table->boolean('finished')->nullable();
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
        Schema::dropIfExists('services');
    }
}
