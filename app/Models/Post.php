<?php

namespace App\Models;

use App\QueryFilters\Active;
use App\QueryFilters\MaxCount;
use App\QueryFilters\Sort;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pipeline\Pipeline;

class Post extends Model
{
    use HasFactory;

    protected $table = 'posts';


    protected $fillable = [
        'title', 'active'
    ];

    public static function allPosts()
    {
        return app(Pipeline::class)
            ->send(Post::query())
            ->through([
                Active::class,
                Sort::class,
                //MaxCount::class
            ])
            ->thenReturn()
            //->get()
            ->paginate(5)
            ;
    }
}
