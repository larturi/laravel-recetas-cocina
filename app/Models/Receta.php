<?php

namespace App\Models;

use App\Models\User;
use App\Models\CategoriaReceta;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Receta extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'titulo', 'preparacion', 'ingredientes', 'imagen', 'categoria_id',
    ];

    // Obtiene la categoria de la receta via FK
    public function categoria()
    {
        return $this->belongsTo(CategoriaReceta::class);
    }

    // Obtiene la informacion del Usuario via FK
    public function autor()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Likes de la receta
    public function likes()
    {
        return $this->belongsToMany(User::class, 'likes_receta');
    }

}
