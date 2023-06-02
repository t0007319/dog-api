<?php

namespace App\GraphQL\Queries;

use App\Models\Breed;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class Breeds
{
    public function __invoke($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        return Breed::all();
    }
}
