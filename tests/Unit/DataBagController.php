<?php

declare(strict_types=1);

namespace Tests\Unit;

use PreemStudio\DataBags\ResolverFactory;

class DataBagController
{
    public function __invoke()
    {
        return ResolverFactory::make('controller', 'meta');
    }
}
