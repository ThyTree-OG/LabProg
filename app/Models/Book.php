<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $guarded=['id'];
    protected $fillable = [
        'title',
        'description',
        'cover_url',
        'read_time',
        'rating_medio',
        'age_group',
        'is_active',
        'access_level',
        'pdf_path',
    ];
    
    public function authors()
{
    return $this->belongsToMany(Author::class, 'author_books', 'book_id', 'author_id');
}

}
