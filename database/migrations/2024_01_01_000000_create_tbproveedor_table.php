<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('tbproveedor', function (Blueprint $table) {
            $table->id('proveedor_id');
            $table->string('nombre', 100);
            $table->string('telefono', 20);
            $table->string('correo', 100);
            $table->text('direccion');
            $table->decimal('total_compras', 10, 2)->default(0.00);
            $table->enum('estado', ['Activo', 'Inactivo'])->default('Activo');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tbproveedor');
    }
};