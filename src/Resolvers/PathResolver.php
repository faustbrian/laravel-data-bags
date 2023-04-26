<?php

declare(strict_types=1);

namespace BombenProdukt\DataBags\Resolvers;

use Illuminate\Support\Facades\Request;
use BombenProdukt\DataBags\Contracts\Resolver;

final class PathResolver implements Resolver
{
    use Concerns\InteractsWithBag;

    public function resolve(array $bags, string $key): mixed
    {
        return $this->resolveFromBag($bags, $key, Request::path());
    }
}
