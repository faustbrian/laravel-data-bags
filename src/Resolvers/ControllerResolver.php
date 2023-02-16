<?php

declare(strict_types=1);

namespace PreemStudio\DataBags\Resolvers;

use Illuminate\Support\Facades\Route;
use PreemStudio\DataBags\Contracts\Resolver;

class ControllerResolver implements Resolver
{
    use Concerns\InteractsWithBag;

    public function resolve(array $bags, string $key): mixed
    {
        return $this->resolveFromBag($bags, $key, Route::current()->getActionName());
    }
}
