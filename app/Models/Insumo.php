<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Insumo extends Model
{
    use HasFactory;

    protected $table = 'tbinsumo';
    protected $primaryKey = 'insumo_id';
    public $timestamps = true;

    protected $fillable = [
        'nombre',
        'stock_actual',
        'stock_minimo',
        'fecha_vencimiento',
        'unidad_medida',
        'cantidad',
        'precio',
        'estado'
    ];

    protected $casts = [
        'fecha_vencimiento' => 'date',
        'precio' => 'decimal:2'
    ];

    // Relación muchos a muchos con Proveedor
    public function proveedores()
    {
        return $this->belongsToMany(Proveedor::class, 'tbproveedor_insumo', 'insumo_id', 'proveedor_id');
    }
}