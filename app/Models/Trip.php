<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
