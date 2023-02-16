<?php

declare(strict_types=1);

namespace PreemStudio\DataBags\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use PreemStudio\DataBags\View\Components\DataBag;

class DataBagsServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Blade::component('data-bag', DataBag::class);
    }
}
