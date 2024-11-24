<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\DataBags\View\Components;

use BaseCodeOy\DataBags\ResolverFactory;
use Illuminate\Support\Facades\View;
use Illuminate\View\Component;

final class DataBag extends Component
{
    public function __construct(
        private string $key,
        private string $resolver,
        private string $view,
    ) {}

    public function render(): \Illuminate\Contracts\View\View
    {
        return View::make($this->view, ResolverFactory::make($this->resolver, $this->key));
    }
}
