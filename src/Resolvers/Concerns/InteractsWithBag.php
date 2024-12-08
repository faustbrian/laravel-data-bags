<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Datbag\Resolvers\Concerns;

use Illuminate\Support\Arr;

trait InteractsWithBag
{
    private function resolveFromBag(array $bags, string $key, string $path): mixed
    {
        if (Arr::has($bags, \sprintf('%s.%s', $key, $path))) {
            return Arr::get($bags, \sprintf('%s.%s', $key, $path));
        }

        return Arr::get($bags, $key.'.*');
    }
}
