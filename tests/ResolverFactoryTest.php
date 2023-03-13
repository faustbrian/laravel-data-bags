<?php

declare(strict_types=1);

namespace Tests;

use Illuminate\Support\Facades\Route;
use PreemStudio\DataBags\DataBag;
use PreemStudio\DataBags\ResolverFactory;

it('should resolve via controller', function () {
    DataBag::register('meta', [
        DataBagController::class => [
            'title' => 'Hello World',
        ],
    ]);

    Route::get('/posts/hello-world', DataBagController::class);

    expect($this->call('GET', '/posts/hello-world')->json())->toBe(['title' => 'Hello World']);
});

it('should resolve via domain', function () {
    DataBag::register('meta', [
        'local.app' => [
            'title' => 'Hello World',
        ],
    ]);

    Route::domain('local.app')->group(function () {
        Route::get('/posts', fn () => ResolverFactory::make('domain', 'meta'));
    });

    expect($this->call('GET', 'https://local.app/posts')->json())->toBe(['title' => 'Hello World']);
});

it('should resolve via name', function () {
    DataBag::register('meta', [
        'post' => [
            'title' => 'Hello World',
        ],
    ]);

    Route::get('/posts/hello-world', fn () => ResolverFactory::make('name', 'meta'))->name('post');

    expect($this->call('GET', '/posts/hello-world')->json())->toBe(['title' => 'Hello World']);
});

it('should resolve via path', function () {
    DataBag::register('meta', [
        'posts/hello-world' => [
            'title' => 'Hello World',
        ],
    ]);

    Route::get('/posts/hello-world', fn () => ResolverFactory::make('path', 'meta'));

    expect($this->call('GET', '/posts/hello-world')->json())->toBe(['title' => 'Hello World']);
});

it('should resolve via glob', function () {
    DataBag::register('meta', [
        'posts/*' => [
            'title' => 'Hello World',
        ],
    ]);

    Route::get('/posts/hello-world', fn () => ResolverFactory::make('glob', 'meta'));

    expect($this->call('GET', '/posts/hello-world')->json())->toBe(['title' => 'Hello World']);
});

it('should resolve via regex', function () {
    DataBag::register('meta', [
        '|(posts/hello-*)|' => [
            'title' => 'Hello World',
        ],
    ]);

    Route::get('/posts/hello-world', fn () => ResolverFactory::make('regex', 'meta'));

    expect($this->call('GET', '/posts/hello-world')->json())->toBe(['title' => 'Hello World']);
});
