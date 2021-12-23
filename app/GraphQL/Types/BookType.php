<?php

namespace App\GraphQL\Types;

use App\Models\Book;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Type as GraphQLType;

class BookType extends GraphQLType
{

    protected $attributes = [
        'name'          => 'Book', //defining the GraphQL type name
        'description'   => 'A books', //providing a description for the GraphQL type name
        'model'         => Book::class, //mapping the GraphQL type to the Laravel model
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'The id of the book',
            ],
            'title' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The title of book',
                'resolve' => function($root, array $args) {
                    // If you want to resolve the field yourself,
                    // it can be done here
                    return ucfirst($root->title);
                }
            ],
            'year' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'The year of book',
            ],
            'number_of_pages' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'The number of page of book',
            ],
            'user' => [
                'type' => GraphQL::type('User'),
                'description' => 'this is user write this book',
            ]
        ];
    }

    protected function resolveTitleField($root, array $args)
    {
        return ucfirst($root->title);
    }
}
