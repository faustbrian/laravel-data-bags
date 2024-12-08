<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Datbag\Resolvers;

use BaseCodeOy\Datbag\Contracts\Resolver;
use Illuminate\Support\Facades\Route;

final class NameResolver implements Resolver
{
    use Concerns\InteractsWithBag;

    #[\Override()]
    public function resolve(array $bags, string $key): mixed
    {
        return $this->resolveFromBag($bags, $key, Route::current()->getName());
    }
}
