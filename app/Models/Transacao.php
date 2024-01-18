<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transacao extends Model
{
    use HasFactory;
    protected $table = 'transacoes';
    protected $fillable = [
        'user_id', // Adicione 'user_id' aqui se deseja permitir o preenchimento em massa dessa coluna
        // Outros campos preenchíveis em massa, se houver
    ];

}
