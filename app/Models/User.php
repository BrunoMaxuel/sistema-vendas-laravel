<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    public function clientes()
    {
        return $this->hasMany(Cliente::class);
    }
    public function produtos(){
        return $this->hasMany(Produto::class);
    }
    public function vendas(){
        return $this->hasMany(Venda::class);
    }
    public function suprimentos(){
        return $this->hasMany(Suprimento::class);
    }
    public function sangrias(){
        return $this->hasMany(Sangria::class);
    }
    public function transacoes(){
        return $this->hasMany(Transacao::class);
    }
    public function caixas(){
        return $this->hasMany(Caixa::class);
    }
}
