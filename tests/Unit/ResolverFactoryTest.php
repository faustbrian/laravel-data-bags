<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Tests\Unit;

use BaseCodeOy\Datbag\DataBag;
use BaseCodeOy\Datbag\ResolverFactory;
use Illuminate\Support\Facades\Route;

it('should resolve via controller', function (): void {
    DataBag::register('meta', [
        DataBagController::class => [
            'title' => 'Hello World',
        ],
    ]);

    Route::get('/posts/hello-world', DataBagController::class);

    expect($this->call('GET', '/posts/hello-world')->json())->toBe(['title' => 'Hello World']);
});

it('should resolve via domain', function (): void {
    DataBag::register('meta', [
        'local.app' => [
            'title' => 'Hello World',
        ],
    ]);

    Route::domain('local.app')->group(function (): void {
        Route::get('/posts', fn () => ResolverFactory::make('domain', 'meta'));
    });

    expect($this->call('GET', 'https://local.app/posts')->json())->toBe(['title' => 'Hello World']);
});

it('should resolve via name', function (): void {
    DataBag::register('meta', [
        'post' => [
            'title' => 'Hello World',
        ],
    ]);

    Route::get('/posts/hello-world', fn () => ResolverFactory::make('name', 'meta'))->name('post');

    expect($this->call('GET', '/posts/hello-world')->json())->toBe(['title' => 'Hello World']);
});

it('should resolve via path', function (): void {
    DataBag::register('meta', [
        'posts/hello-world' => [
            'title' => 'Hello World',
        ],
    ]);

    Route::get('/posts/hello-world', fn () => ResolverFactory::make('path', 'meta'));

    expect($this->call('GET', '/posts/hello-world')->json())->toBe(['title' => 'Hello World']);
});

it('should resolve via glob', function (): void {
    DataBag::register('meta', [
        'posts/*' => [
            'title' => 'Hello World',
        ],
    ]);

    Route::get('/posts/hello-world', fn () => ResolverFactory::make('glob', 'meta'));

    expect($this->call('GET', '/posts/hello-world')->json())->toBe(['title' => 'Hello World']);
});

it('should resolve via regex', function (): void {
    DataBag::register('meta', [
        '|(posts/hello-*)|' => [
            'title' => 'Hello World',
        ],
    ]);

    Route::get('/posts/hello-world', fn () => ResolverFactory::make('regex', 'meta'));

    expect($this->call('GET', '/posts/hello-world')->json())->toBe(['title' => 'Hello World']);
});
