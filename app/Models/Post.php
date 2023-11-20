<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    //protected $fillable = ['title', 'excerpt', 'body'];

    protected $with = ['category', 'author'];

    protected $casts = [
        'published_at' => 'datetime:Y-m-d',
    ];

    public function scopeFilter($query, array $filters) 
    {
        $query->when($filters['search'] ?? false, fn ($query, $search) =>
            $query->where('title', 'like', '%' . trim($search) . '%')
            ->orWhere('excerpt', 'like', '%' . trim($search) . '%')
            ->orWhere('body', 'like', '%' . trim($search) . '%'));        
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
