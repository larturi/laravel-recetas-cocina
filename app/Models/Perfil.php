<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Perfil extends Model
{
    use HasFactory;

    // Relacion 1:1 de perfil con usuario
    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
