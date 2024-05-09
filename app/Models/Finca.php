<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Finca extends Model
{
    use HasFactory;

    protected $table = 'fincas';
    protected $primaryKey = ['num_catastro', 'municipio'];
    public $incrementing = false;

    public function productor()
    {
        return $this->belongsTo(Productor::class, 'productores_id', 'documento');
    }

    public function viveros()
    {
        return $this->hasMany(Vivero::class, 'num_catastro', 'num_catastro')->where('municipio', $this->municipio);
    }

}
