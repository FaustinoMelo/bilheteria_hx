<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Passageiros extends Model
{
    use HasFactory;

    protected $table = "passageiros";
    protected $fillable = [
        "nif",
        "nomeCompleto",
        "Nacionalidade",
        "provincia",
        "residencia_actual",
        "contacto_id",
        "email",
        "bi",
        "dataNascimento",
        "user_id"
    ];
}
