<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LocalEmbarque extends Model
{
    use HasFactory;
    protected $table = "local_embarque";

    protected $fillable = [
        'nomeLocal',
        'user_id',
        'estado',

    ];
}
