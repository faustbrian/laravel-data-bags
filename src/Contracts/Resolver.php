<?php

declare(strict_types=1);

namespace PreemStudio\DataBags\Contracts;

interface Resolver
{
    public function resolve(array $bags, string $key): mixed;
}
