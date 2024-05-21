<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['content', 'user_id', 'is_active', 'image_path'];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where('content', 'like', '%' . $search . '%');
        });
    }

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

    public function Comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function Likes()
    {
        return $this->hasMany(Like::class);
    }
}
