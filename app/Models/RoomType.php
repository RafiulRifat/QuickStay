<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RoomType extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function room()
    {
        return $this->hasMany(Room::class, 'roomtype_id', 'id');
    }
}