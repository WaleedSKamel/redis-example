<?php

namespace App\GraphQL\Queries;

use App\Models\Book;
use Closure;
use Rebing\GraphQL\Support\Facades\GraphQL;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;

class BookQuery extends Query
{
    protected $attributes = [
        'name' => 'book',
    ];

    public function type(): Type
    {
        return GraphQL::type('Book'); //BookType
    }


    public function args(): array
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::int(),
            ],
            'title' => [
                'name' => 'title',
                'type' => Type::string(),
            ],
            'year' => [
                'name' => 'year',
                'type' => Type::int(),
            ],
            'number_of_pages' => [
                'name' => 'number_of_pages',
                'type' => Type::int(),
            ]
        ];
    }

    public function resolve($root, array $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {

        if (isset($args['id'])) {
            return Book::query()->findOrFail($args['id']);
        }

        if (isset($args['title'])) {
            return Book::query()->where('title', 'like', '%'.$args['title'].'%')->get();
        }

        if (isset($args['year'])) {
            return Book::query()->where('year','=',$args['year'])->get();
        }


        if (isset($args['number_of_pages'])) {
            return Book::query()->where('number_of_pages','=',$args['number_of_pages'])->get();
        }

        return Book::all();
    }
}
