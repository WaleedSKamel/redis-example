<?php

namespace App\GraphQL\Mutations;

use App\Models\Book;
use App\Models\User;
use Closure;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;

class CreateUserMutation extends Mutation
{

    protected $attributes = [
        'name' => 'createUser'
    ];

    public function authorize($root, array $args, $ctx, ResolveInfo $resolveInfo = null, Closure $getSelectFields = null): bool
    {
        // true, if logged in
        return  true; //Auth::guest();
    }

    public function type(): Type
    {
        return GraphQL::type('User');
    }

    public function args(): array
    {
        return [
            'name' => [
                'name' => 'name',
                'type' => Type::string(),
                'rules' => ['required', 'string', 'min:2', 'max:255']
            ],
            'email' => [
                'name' => 'email',
                'type' => Type::string(),
                'rules' => ['required', 'string','email',Rule::unique('users','email'), 'min:2', 'max:255']
            ],
            'password' => [
                'name' => 'password',
                'type' => Type::string(),
                'rules' => ['required', 'string', 'min:2', 'max:255']
            ],
        ];
    }

    public function resolve($root, array $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        try {
            DB::beginTransaction();
            $user = User::query()->create($args);
            if ($user) {
                DB::commit();
                return $user;
            }
        } catch (\Exception $exception) {
            DB::rollBack();
            return $exception->getMessage();
        }
    }

    public function validationErrorMessages(array $args = []): array
    {
        return [
            'name.required' => 'Please enter your full name',
            'name.string' => 'Your name must be a valid string',
            'email.required' => 'Please enter your email address',
            'email.email' => 'Please enter a valid email address',
            'email.exists' => 'Sorry, this email address is already in use',
            'email.unique' => 'Sorry, this email address is already in use',
        ];
    }
}
