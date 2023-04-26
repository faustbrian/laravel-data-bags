<?php

declare(strict_types=1);

namespace BombenProdukt\DataBags\Resolvers;

use Illuminate\Support\Facades\Route;
use BombenProdukt\DataBags\Contracts\Resolver;

final class NameResolver implements Resolver
{
    use Concerns\InteractsWithBag;

    public function resolve(array $bags, string $key): mixed
    {
        return $this->resolveFromBag($bags, $key, Route::current()->getName());
    }
}
