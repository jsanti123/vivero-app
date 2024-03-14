<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Productor extends Model
{
    use HasFactory;

    protected $table = 'productores';
    protected $primaryKey = 'documento';

    public function fincas()
    {
        return $this->hasMany(Finca::class, 'productores_id', 'documento');
    }

}
