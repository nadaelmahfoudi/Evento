<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $fillable = ['titre', 'description', 'date', 'lieu' , 'category_id' , 'capacity'];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
