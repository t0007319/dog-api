<?php

namespace App\GraphQL\Queries;

use App\Models\User;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class Users
{
    public function __invoke($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        return User::all();
    }
}
