<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\URL;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'lastname',
        'middlename',
        'username',
        'email',
        'password',
        'is_admin',
        'phone',
        'address',
        'photo',
        'prefixname',
        'suffixname',
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

    public function getPhotoAttribute()
    {
        $photoPath = $this->attributes['photo'];
        return asset('storage/' . $photoPath);
    }

    public function getFullnameAttribute()
    {
        return $this->attributes['prefixname'] . ' ' . $this->attributes['firstname'].' '. mb_substr($this->attributes['middlename'], 0, 1) . '. ' . $this->attributes['lastname'];
    }

    public function getMiddleinitialAttribute()
    {
        return mb_substr($this->attributes['middlename'], 0, 1) . '. ';
    }
}
