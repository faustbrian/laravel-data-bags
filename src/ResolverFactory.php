<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Datbag;

final class ResolverFactory
{
    public static function make(string $resolver, string $key)
    {
        try {
            $resolver = match ($resolver) {
                'controller' => fn (string $key): mixed => DataBag::resolveByController($key),
                'domain' => fn (string $key): mixed => DataBag::resolveByDomain($key),
                'glob' => fn (string $key): mixed => DataBag::resolveByGlob($key),
                'name' => fn (string $key): mixed => DataBag::resolveByName($key),
                'path' => fn (string $key): mixed => DataBag::resolveByPath($key),
                'regex' => fn (string $key): mixed => DataBag::resolveByRegex($key),
            };

            return $resolver($key);
        } catch (\Throwable) {
            throw new \InvalidArgumentException(\sprintf('Failed to find a resolver for [%s]', $resolver));
        }
    }
}
