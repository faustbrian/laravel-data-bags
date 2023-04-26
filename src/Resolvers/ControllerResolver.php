<?php

declare(strict_types=1);

namespace BombenProdukt\DataBags\Resolvers;

use BombenProdukt\DataBags\Contracts\Resolver;
use Illuminate\Support\Facades\Route;

final class ControllerResolver implements Resolver
{
    use Concerns\InteractsWithBag;

    public function resolve(array $bags, string $key): mixed
    {
        return $this->resolveFromBag($bags, $key, Route::current()->getActionName());
    }
}
