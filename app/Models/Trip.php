<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     schema="Trip",
 *     type="object",
 *     title="Trip",
 *     required={"starting_point", "ending_point", "starting_at", "available_places", "price"},
 *     @OA\Property(property="id", type="integer", readOnly=true, example=1),
 *     @OA\Property(property="starting_point", type="string", example="Paris"),
 *     @OA\Property(property="ending_point", type="string", example="Lyon"),
 *     @OA\Property(property="starting_at", type="string", format="date-time", example="2024-07-23T10:00:00Z"),
 *     @OA\Property(property="available_places", type="integer", example=3),
 *     @OA\Property(property="price", type="integer", example=20),
 *     @OA\Property(property="user_id", type="integer", example=1)
 * )
 */

class Trip extends Model
{
    use HasFactory;

    protected $fillable = [
        'starting_point', 'ending_point', 'starting_at', 'available_places', 'price', 'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
