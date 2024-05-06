<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['content', 'user_id', 'is_active', 'image_path'];

    public function User()
    {
        return $this->belongsTo(User::class, 'user_id'); // Assuming user_id is the foreign key in posts table
    }
}
