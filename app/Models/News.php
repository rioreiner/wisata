<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class News extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'slug', 'content', 'excerpt', 
        'image', 'status', 'author_id'
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}