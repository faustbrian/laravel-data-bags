<?php

declare(strict_types=1);

namespace BombenProdukt\DataBags\Resolvers;

use BombenProdukt\DataBags\Contracts\Resolver;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Request;

final class GlobResolver implements Resolver
{
    public function resolve(array $bags, string $key): mixed
    {
        $bag = Arr::get($bags, $key);
        $subjects = \array_keys($bag);

        foreach ($subjects as $subject) {
            if (\fnmatch($subject, Request::path())) {
                return $bag[$subject];
            }
        }

        return null;
    }
}
