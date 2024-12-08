<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Datbag\Resolvers;

use BaseCodeOy\Datbag\Contracts\Resolver;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Request;
use Spatie\Regex\Regex;

final class RegexResolver implements Resolver
{
    #[\Override()]
    public function resolve(array $bags, string $key): mixed
    {
        $bag = Arr::get($bags, $key);
        $subjects = \array_keys($bag);

        foreach ($subjects as $subject) {
            if (Regex::match($subject, Request::path())->hasMatch()) {
                return $bag[$subject];
            }
        }

        return null;
    }
}
