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
