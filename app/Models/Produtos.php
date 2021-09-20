<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produtos extends Model
{
    use HasFactory;
    protected $table = 'produtos';
    protected $fillable = [
        'nome',
        'imagem',
        'id_categoria'
    ];

    public function categoria(){
        return $this->belongsTo(Categorias::class);
    }
}
