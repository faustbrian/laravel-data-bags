<?php

declare(strict_types=1);

namespace BaseCodeOy\DataBags\Resolvers;

use BaseCodeOy\DataBags\Contracts\Resolver;
use Illuminate\Support\Facades\Route;

final class NameResolver implements Resolver
{
    use Concerns\InteractsWithBag;

    public function resolve(array $bags, string $key): mixed
    {
        return $this->resolveFromBag($bags, $key, Route::current()->getName());
    }
}
