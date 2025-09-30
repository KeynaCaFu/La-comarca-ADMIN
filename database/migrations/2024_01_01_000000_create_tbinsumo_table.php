<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('tbinsumo', function (Blueprint $table) {
            $table->id('insumo_id');
            $table->string('nombre', 100);
            $table->integer('stock_actual')->default(0);
            $table->integer('stock_minimo')->default(0);
            $table->date('fecha_vencimiento')->nullable();
            $table->string('unidad_medida', 50);
            $table->integer('cantidad');
            $table->decimal('precio', 8, 2);
            $table->enum('estado', ['Disponible', 'Agotado', 'Vencido'])->default('Disponible');
        });
    }

    public function down()
    {
        Schema::dropIfExists('tbinsumo');
    }
};