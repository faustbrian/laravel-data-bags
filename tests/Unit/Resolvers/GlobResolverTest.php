<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Tests\Unit\Resolvers;

use BaseCodeOy\DataBags\DataBag;
use BaseCodeOy\DataBags\Resolvers\GlobResolver;
use Illuminate\Support\Facades\Route;

it('should match by a glob pattern', function (): void {
    expect((new GlobResolver())->resolve([
        'meta' => [
            '/*' => [
                'title' => 'Any',
            ],
        ],
    ], 'meta'))->toBe(['title' => 'Any']);
});

it('should match by a glob pattern through a request', function (): void {
    DataBag::register('meta', [
        'posts/*' => [
            'title' => 'Hello World',
        ],
        '*' => [
            'title' => 'Any',
        ],
    ]);

    Route::get('/', fn () => DataBag::resolveByGlob('meta'));
    Route::get('/posts', fn () => DataBag::resolveByGlob('meta'));
    Route::get('/posts/hello-world', fn () => DataBag::resolveByGlob('meta'));

    expect($this->call('GET', '/')->json())->toBe(['title' => 'Any']);
    expect($this->call('GET', '/posts')->json())->toBe(['title' => 'Any']);
    expect($this->call('GET', '/posts/hello-world')->json())->toBe(['title' => 'Hello World']);
});
