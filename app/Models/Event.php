<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $fillable = ['titre', 'description', 'lieu', 'date', 'capacity', 'image', 'validation', 'accepted', 'category_id' , 'user_id'];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
    
    public function user(){
        return $this->belongsTo(User::class);
    }
}
