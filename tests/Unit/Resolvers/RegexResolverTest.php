<?php

declare(strict_types=1);

namespace Tests\Unit\Resolvers;

use BaseCodeOy\DataBags\DataBag;
use BaseCodeOy\DataBags\Resolvers\RegexResolver;
use Illuminate\Support\Facades\Route;

it('should match by a glob pattern', function (): void {
    expect((new RegexResolver())->resolve([
        'meta' => [
            '|(/*)|' => [
                'title' => 'Any',
            ],
        ],
    ], 'meta'))->toBe(['title' => 'Any']);
});

it('should match by a glob pattern through a request', function (): void {
    DataBag::register('meta', [
        '|(posts/hello-*)|' => [
            'title' => 'Hello World',
        ],
        '/(.*)/' => [
            'title' => 'Any',
        ],
    ]);

    Route::get('/', fn () => DataBag::resolveByRegex('meta'));
    Route::get('/posts', fn () => DataBag::resolveByRegex('meta'));
    Route::get('/posts/hello-world', fn () => DataBag::resolveByRegex('meta'));

    expect($this->call('GET', '/')->json())->toBe(['title' => 'Any']);
    expect($this->call('GET', '/posts')->json())->toBe(['title' => 'Any']);
    expect($this->call('GET', '/posts/hello-world')->json())->toBe(['title' => 'Hello World']);
});
