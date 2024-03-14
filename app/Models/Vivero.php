<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vivero extends Model
{
    use HasFactory;

    protected $table = 'viveros';
    protected $primaryKey = 'codigo';

    public function finca()
    {
        return $this->belongsTo(Finca::class, 'num_catastro', 'num_catastro')->where('municipio', $this->municipio);
    }


    public function labores()
    {
        return $this->hasMany(Labor::class, 'vivero_id', 'codigo');
    }

    public function countLabores()
    {
        return $this->labores()->count();
    }


}
