<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $table = 'books';

    protected $fillable = [
        'title', 'year', 'number_of_pages','user_id'
    ];

    // relation

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
}
