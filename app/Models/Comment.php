<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['content', 'user_id', 'post_id', 'is_active'];

    // upon delete, set is_active to 0
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($post) {
            $post->is_active = 0;
            $post->save();
        });
    }

    public function User()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function Post()
    {
        return $this->belongsTo(Post::class, 'post_id');
    }
}
