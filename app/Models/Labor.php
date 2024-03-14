<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Labor extends Model
{
    use HasFactory;

    protected $table = 'labores';
    protected $primaryKey = 'id';

    public function vivero()
    {
        return $this->belongsTo(Vivero::class, 'vivero_id', 'codigo');
    }

    public function productos()
    {
        return $this->belongsToMany(ProductosControl::class, 'labor_producto', 'labor_id', 'producto_id')
        ->withPivot('periodo_carencia', 'fecha_ultima_aplicacion', 'hongo');
    }
}
