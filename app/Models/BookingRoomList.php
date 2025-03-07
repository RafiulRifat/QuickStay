<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingRoomList extends Model
{
    use HasFactory;

    // Allow mass assignment
    protected $guarded = [];

    // If the table name differs from the default convention
    protected $table = 'booking_room_lists'; 

    // Define relationships
    public function booking()
    {
        return $this->belongsTo(Booking::class, 'booking_id');
    }

    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }
}
