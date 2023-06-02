<?php

namespace App\GraphQL\Queries;

use App\Models\Park;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class Parks
{
    public function __invoke($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        return Park::all();
    }
}
