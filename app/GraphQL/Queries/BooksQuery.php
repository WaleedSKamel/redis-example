<?php

namespace App\GraphQL\Queries;

use App\Models\Book;
use Closure;
use Rebing\GraphQL\Support\Facades\GraphQL;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;

class BooksQuery extends Query
{
    protected $attributes = [
        'name' => 'books',
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('Book'));
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

        /** @var SelectFields $fields */

        $fields = $getSelectFields();
        $select = $fields->getSelect();
        $with = $fields->getRelations();

        $books = Book::query()->select($select)->with($with);

        if (isset($args['id'])) {
            return $books->where('id', '=',$args['id'])->get();
        }

        if (isset($args['title'])) {
            return $books->where('title', 'LIKE', '%'.$args['title'].'%')->get();
        }

        if (isset($args['year'])) {
            return $books->where('year','=',$args['year'])->get();
        }


        if (isset($args['number_of_pages'])) {
            return $books->where('number_of_pages','=',$args['number_of_pages'])->get();
        }

        return $books->orderByDesc('created_at')->get();
    }
}
