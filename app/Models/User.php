<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'is_active',
        'role_id',
        'name',
        'email',
        'first_name',
        'last_name',
        'gender',
        'date_of_birth',
        'password',
        'profile_image_path'
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
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // upon delete, set is_active to 0
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($user) {
            $user->is_active = 0;
            $user->save();
        });
    }

    public function Posts()
    {
        return $this->hasMany(Post::class, "user_id");
    }

    public function Comments()
    {
        return $this->hasMany(Comment::class, "user_id");
    }

    public function Likes()
    {
        return $this->hasMany(Like::class, "user_id");
    }

    public function FollowsFirst()
    {
        return $this->hasMany(Follow::class, "first_user_id");
    }

    public function FollowsSecond()
    {
        return $this->hasMany(Follow::class, "second_user_id");
    }
}
