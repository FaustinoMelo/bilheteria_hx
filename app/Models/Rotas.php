<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rotas extends Model
{
    use HasFactory;
    protected $fillable = [
        "nomeRota",
        "horario_id",
        "preco",
        "extensao",
        "duracao",
        "n_paragem",
        "desconto",
        "user_id",
        "estado",
    ];
}
