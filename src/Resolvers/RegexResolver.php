<?php

declare(strict_types=1);

namespace PreemStudio\DataBags\Resolvers;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Request;
use PreemStudio\DataBags\Contracts\Resolver;
use Spatie\Regex\Regex;

final class RegexResolver implements Resolver
{
    public function resolve(array $bags, string $key): mixed
    {
        $bag      = Arr::get($bags, $key);
        $subjects = array_keys($bag);

        foreach ($subjects as $subject) {
            if (Regex::match($subject, Request::path())->hasMatch()) {
                return $bag[$subject];
            }
        }

        return null;
    }
}
