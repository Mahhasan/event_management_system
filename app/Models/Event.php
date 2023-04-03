<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'title', 'description', 'start_datetime', 'end_datetime', 'location', 'price', 'capacity', 'image'];

    public function registrations()
    {
        return $this->hasMany(Registration::class);
    }

    public function isRegistrationOpen()
    {
        return $this->start_date->isFuture();
    }

    public function getRemainingCapacity()
    {
        return $this->capacity - $this->registrations->count();
    }
}