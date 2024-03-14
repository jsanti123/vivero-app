<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductosControl extends Model
{
    use HasFactory;

    protected $table = 'productoscontrol';
    protected $primaryKey = 'ICA';

    public function labores()
    {
        return $this->belongsToMany(Labor::class, 'labor_producto', 'producto_id', 'labor_id')
        ->withPivot('periodo_carencia', 'fecha_ultima_aplicacion', 'hongo');
    }

}
