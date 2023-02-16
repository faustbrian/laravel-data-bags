<?php

declare(strict_types=1);

namespace PreemStudio\DataBags;

use PreemStudio\DataBags\Resolvers\ControllerResolver;
use PreemStudio\DataBags\Resolvers\DomainResolver;
use PreemStudio\DataBags\Resolvers\GlobResolver;
use PreemStudio\DataBags\Resolvers\NameResolver;
use PreemStudio\DataBags\Resolvers\PathResolver;
use PreemStudio\DataBags\Resolvers\RegexResolver;

final class DataBag
{
    private static array $bags = [];

    public static function register(string $key, array $data): void
    {
        static::$bags[$key] = $data;
    }

    public static function resolveByController(string $key): mixed
    {
        return (new ControllerResolver)->resolve(static::$bags, $key);
    }

    public static function resolveByDomain(string $key): mixed
    {
        return (new DomainResolver)->resolve(static::$bags, $key);
    }

    public static function resolveByName(string $key): mixed
    {
        return (new NameResolver)->resolve(static::$bags, $key);
    }

    public static function resolveByPath(string $key): mixed
    {
        return (new PathResolver)->resolve(static::$bags, $key);
    }

    public static function resolveByGlob(string $key): mixed
    {
        return (new GlobResolver)->resolve(static::$bags, $key);
    }

    public static function resolveByRegex(string $key): mixed
    {
        return (new RegexResolver)->resolve(static::$bags, $key);
    }
}
