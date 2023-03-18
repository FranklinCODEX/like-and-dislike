<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $user_id
 * @property integer $post_id
 * @property boolean $like
 * @property boolean $dislike
 * @property string $created_at
 * @property string $updated_at
 * @property Post $post
 * @property User $user
 */
class Like extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['user_id', 'post_id', 'like', 'dislike', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function post()
    {
        return $this->belongsTo('App\Models\Post');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
