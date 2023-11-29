<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rotas extends Model
{
    use HasFactory;
    protected $fillable = [
        "origem",
        "destino",
        "horario_id",
        "preco",
        "extensao",
        "duracao",
        "total_ocupantes",
        "n_paragem",
        "desconto",
        "user_id",
        "estado",
        "local_embarque_id"
    ];
}
