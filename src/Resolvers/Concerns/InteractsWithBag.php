<?php

declare(strict_types=1);

namespace BaseCodeOy\DataBags\Resolvers\Concerns;

use Illuminate\Support\Arr;

trait InteractsWithBag
{
    private function resolveFromBag(array $bags, string $key, string $path): mixed
    {
        if (Arr::has($bags, "{$key}.{$path}")) {
            return Arr::get($bags, "{$key}.{$path}");
        }

        return Arr::get($bags, "{$key}.*");
    }
}
