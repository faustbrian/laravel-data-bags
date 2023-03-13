<?php

declare(strict_types=1);

namespace Tests;

use PreemStudio\DataBags\ResolverFactory;

final class DataBagController
{
    public function __invoke()
    {
        return ResolverFactory::make('controller', 'meta');
    }
}
