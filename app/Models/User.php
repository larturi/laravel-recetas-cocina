<?php

namespace App\Models;

use App\Models\Perfil;
use App\Models\Receta;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'url',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Evento que se ejecuta cuando un usuario es creado
    protected static function boot()
    {
        parent::boot();

        // Asignar perfil una vez se ha creado un nuevo usuario
        static::created(function ($user) {
            $user->perfil()->create();
        });
    }

    // Relacion 1:n de Usuario a Recetas
    public function recetas()
    {
        return $this->hasMany(Receta::class);
    }

    // Relacion 1:1 de usuario y perfil
    public function perfil()
    {
        return $this->hasOne(Perfil::class);
    }

    // Recetas a los que el usuario ha dado like
    public function meGusta()
    {
        return $this->belongsToMany(Receta::class, 'likes_receta');
    }



}
