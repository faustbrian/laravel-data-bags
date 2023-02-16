<?php

declare(strict_types=1);

namespace PreemStudio\DataBags\Resolvers;

use Illuminate\Support\Facades\Request;
use PreemStudio\DataBags\Contracts\Resolver;

class PathResolver implements Resolver
{
    use Concerns\InteractsWithBag;

    public function resolve(array $bags, string $key): mixed
    {
        return $this->resolveFromBag($bags, $key, Request::path());
    }
}
