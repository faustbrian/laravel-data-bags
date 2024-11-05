<?php

declare(strict_types=1);

namespace BaseCodeOy\DataBags\Providers;

use BaseCodeOy\DataBags\View\Components\DataBag;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

final class DataBagsServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Blade::component('data-bag', DataBag::class);
    }
}
