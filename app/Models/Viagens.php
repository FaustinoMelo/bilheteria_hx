<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Viagens extends Model
{
    use HasFactory;

    protected $table = "vendas";

    protected $fillable =[
        "rota_id",  
        "dataViagem",  
        "horaViagem",  
        "n_assento",  
        "n_bilhete", 
        "pagamento_id",  
        "passageiro_id",  
        "user_id",  
        "estado",  
        "observacao",
    ];
}
