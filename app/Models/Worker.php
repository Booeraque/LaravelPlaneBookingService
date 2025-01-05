<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Worker extends User
{
    use HasFactory;

    protected $fillable = [
        'person_id',
        'date_of_employment',
        'is_admin',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'person_id');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
