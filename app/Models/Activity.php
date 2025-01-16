<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $fillable = [
        'title',
        'description',
    ];

    public function books()
    {
        return $this->belongsToMany(Book::class, 'activity_book', 'activity_id', 'book_id');
    }
}
