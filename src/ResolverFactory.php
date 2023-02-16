<?php

declare(strict_types=1);

namespace PreemStudio\DataBags;

use InvalidArgumentException;

final class ResolverFactory
{
    public static function make(string $resolver, string $key)
    {
        try {
            $resolver = match ($resolver) {
                'controller'  => fn (string $key) => DataBag::resolveByController($key),
                'domain'      => fn (string $key) => DataBag::resolveByDomain($key),
                'glob'        => fn (string $key) => DataBag::resolveByGlob($key),
                'name'        => fn (string $key) => DataBag::resolveByName($key),
                'path'        => fn (string $key) => DataBag::resolveByPath($key),
                'regex'       => fn (string $key) => DataBag::resolveByRegex($key),
            };

            return $resolver($key);
        } catch (\Throwable $th) {
            throw new InvalidArgumentException("Failed to find a resolver for [$resolver]");
        }
    }
}
