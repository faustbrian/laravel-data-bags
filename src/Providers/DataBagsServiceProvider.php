<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Datbag\Providers;

use BaseCodeOy\Datbag\View\Components\DataBag;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

final class DataBagsServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Blade::component('data-bag', DataBag::class);
    }
}
