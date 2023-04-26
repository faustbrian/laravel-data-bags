<?php

declare(strict_types=1);

namespace BombenProdukt\DataBags\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use BombenProdukt\DataBags\View\Components\DataBag;

final class DataBagsServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Blade::component('data-bag', DataBag::class);
    }
}
