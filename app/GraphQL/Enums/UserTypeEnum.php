<?php

namespace App\GraphQL\Enums;

use Rebing\GraphQL\Support\EnumType;

class UserTypeEnum extends EnumType
{
    protected $attributes = [
        'name' => 'UserTypeEnum',
        'description' => 'The types of demographic elements',
        'values' => [
            'customer' => 'CUSTOMER',
            'vendor' => 'VENDOR',
            'client' => 'CLIENT',
        ],
    ];
}
