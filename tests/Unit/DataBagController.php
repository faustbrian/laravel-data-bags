<?php

declare(strict_types=1);

namespace Tests\Unit;

use BombenProdukt\DataBags\ResolverFactory;

final class DataBagController
{
    public function __invoke()
    {
        return ResolverFactory::make('controller', 'meta');
    }
}
