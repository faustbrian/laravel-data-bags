<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Datbag;

use BaseCodeOy\Datbag\Resolvers\ControllerResolver;
use BaseCodeOy\Datbag\Resolvers\DomainResolver;
use BaseCodeOy\Datbag\Resolvers\GlobResolver;
use BaseCodeOy\Datbag\Resolvers\NameResolver;
use BaseCodeOy\Datbag\Resolvers\PathResolver;
use BaseCodeOy\Datbag\Resolvers\RegexResolver;

final class DataBag
{
    private static array $bags = [];

    public static function register(string $key, array $data): void
    {
        self::$bags[$key] = $data;
    }

    public static function resolveByController(string $key): mixed
    {
        return (new ControllerResolver())->resolve(self::$bags, $key);
    }

    public static function resolveByDomain(string $key): mixed
    {
        return (new DomainResolver())->resolve(self::$bags, $key);
    }

    public static function resolveByName(string $key): mixed
    {
        return (new NameResolver())->resolve(self::$bags, $key);
    }

    public static function resolveByPath(string $key): mixed
    {
        return (new PathResolver())->resolve(self::$bags, $key);
    }

    public static function resolveByGlob(string $key): mixed
    {
        return (new GlobResolver())->resolve(self::$bags, $key);
    }

    public static function resolveByRegex(string $key): mixed
    {
        return (new RegexResolver())->resolve(self::$bags, $key);
    }
}
