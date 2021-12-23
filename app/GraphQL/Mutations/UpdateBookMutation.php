<?php

namespace App\GraphQL\Mutations;

use App\Models\Book;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;

class UpdateBookMutation extends Mutation
{

    protected $attributes = [
        'name' => 'updateBook'
    ];

    public function type(): Type
    {
        return GraphQL::type('Book');
    }

    public function args(): array
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::int(),
                'rules' => ['required', 'integer', Rule::exists('books','id')],
            ],
            'title' => [
                'name' => 'title',
                'type' => Type::string(),
                'rules' => ['required', 'string', 'min:2', 'max:255'],
            ],
            'year' => [
                'name' => 'year',
                'type' => Type::int(),
                'rules' => ['required', 'integer'],
            ],
            'number_of_pages' => [
                'name' => 'number_of_pages',
                'type' => Type::int(),
                'rules' => ['required', 'integer'],
            ],
            'user_id' => [
                'name' => 'user_id',
                'type' => Type::int(),
                'rules' => ['required', 'integer', Rule::exists('users', 'id')],
            ],
        ];
    }

    public function resolve($root, array $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        try {
            DB::beginTransaction();
            $book = Book::query()->findOrFail($args['id']);
            if ($book->update($args)) {
                DB::commit();
                return $book;
            }
        } catch (\Exception $exception) {
            DB::rollBack();
            return $exception->getMessage();
        }
    }
}
