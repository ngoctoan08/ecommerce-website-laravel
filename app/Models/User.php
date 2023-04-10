<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;
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
        'role_id'
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
    ];

    public function categories() 
    {
        return $this->hasMany(Category::class, 'user_id');
    }


    // get profile user by user_id
    // join 2 tbl users and profiles
    public function getInfoUser($id)
    {
        return DB::table('users')
        ->join('profiles', 'users.id', '=', 'profiles.user_id')
        ->select('product_size_stores.size_name', 'product_size_stores.product_id')
        ->where('users.id', '=', $id)
        ->get();
    }


    public function profile()
    {
        return $this->hasOne(Profile::class);
    }
}