<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    use HasFactory;

    protected $table = 'tbproveedor';
    protected $primaryKey = 'proveedor_id';
    public $timestamps = true;

    protected $fillable = [
        'nombre',
        'telefono',
        'correo',
        'direccion',
        'total_compras',
        'estado'
    ];

    protected $casts = [
        'total_compras' => 'decimal:2'
    ];

    // Relación muchos a muchos con Insumo
    public function insumos()
    {
        return $this->belongsToMany(Insumo::class, 'tbproveedor_insumo', 'proveedor_id', 'insumo_id');
    }
}