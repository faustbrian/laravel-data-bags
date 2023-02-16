<?php

declare(strict_types=1);

namespace PreemStudio\DataBags\Resolvers;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;
use PreemStudio\DataBags\Contracts\Resolver;

class DomainResolver implements Resolver
{
    public function resolve(array $bags, string $key): mixed
    {
        $path = Route::current()->getDomain();

        if (! empty($bags[$key][$path])) {
            return $bags[$key][$path];
        }

        return Arr::get($bags, "$key.*");
    }
}
