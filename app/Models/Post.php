<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


/**
 * @property integer $id
 * @property integer $user_id
 * @property string $titre
 * @property string $contenu
 * @property integer $like
 * @property integer $dislike
 * @property string $created_at
 * @property string $updated_at
 * @property User $user
 */
class Post extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    /**
     * @var array
     */
    protected $fillable = ['user_id', 'titre', 'contenu', 'like', 'dislike', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
