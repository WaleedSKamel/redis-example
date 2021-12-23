<?php

namespace App\GraphQL\Queries;

use App\Models\User;
use Closure;
use Rebing\GraphQL\Support\Facades\GraphQL;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;

class UsersQuery extends Query
{
    protected $attributes = [
        'name' => 'users',
    ];

    public function type(): Type
    {
        return Type::listOf(Type::nonNull(GraphQL::type('User')));
    }

    public function args(): array
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::int(),
            ],
            'name' => [
                'name' => 'email',
                'type' => Type::string(),
            ],
            'email' => [
                'name' => 'email',
                'type' => Type::string(),
            ]
        ];
    }

    public function resolve($root, array $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        /** @var SelectFields $fields */

        $fields = $getSelectFields();
        $select = $fields->getSelect();
        $with = $fields->getRelations();

        $users = User::query()->select($select)->with($with);

        if (isset($args['id'])) {
            return $users->where('id' ,'=', $args['id'])->get();
        }

        if (isset($args['email'])) {
            return $users->where('email', '=',$args['email'])->get();
        }

        if (isset($args['name'])) {
            return $users->where('email', 'LIKE',"%{$args['name']}%")->get();
        }

        return $users->orderByDesc('id')->get();
    }

}
