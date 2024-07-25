<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

/**
 * @OA\Schema(
 *     schema="User",
 *     type="object",
 *     required={"id", "lastname", "firstname", "email"},
 *     @OA\Property(property="id", type="integer", description="ID of the user"),
 *     @OA\Property(property="lastname", type="string", description="Last name of the user"),
 *     @OA\Property(property="firstname", type="string", description="First name of the user"),
 *     @OA\Property(property="email", type="string", format="email", description="Email of the user"),
 *     @OA\Property(property="avatar", type="string", description="Avatar URL of the user", nullable=true),
 * )
 */

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'lastname', 'firstname', 'email', 'password', 'role', 'avatar',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function trips()
    {
        return $this->hasMany(Trip::class);
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}