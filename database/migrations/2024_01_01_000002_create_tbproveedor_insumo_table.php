<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('tbproveedor_insumo', function (Blueprint $table) {
            $table->unsignedBigInteger('proveedor_id');
            $table->unsignedBigInteger('insumo_id');
            
            $table->primary(['proveedor_id', 'insumo_id']);
            $table->foreign('proveedor_id')->references('proveedor_id')->on('tbproveedor')->onDelete('cascade');
            $table->foreign('insumo_id')->references('insumo_id')->on('tbinsumo')->onDelete('cascade');
            
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tbproveedor_insumo');
    }
};