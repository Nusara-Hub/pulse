<?php

declare(strict_types=1);

namespace Nusara\Pulse\Http\Filters\User;

use Illuminate\Database\Eloquent\Builder;

final class ByEmail
{
    /**
     * Filters the query builder to only include records where the email column
     * contains the provided email value.
     *
     * @param \Illuminate\Database\Eloquent\Builder $builder The query builder to filter.
     * @param \Closure $next The next filter in the chain.
     * @return \Illuminate\Database\Eloquent\Builder The filtered query builder.
     */
    public function handle(Builder $builder, \Closure $next): Builder
    {
        return $next($builder)
            ->when(request()->has('email'),
                fn ($q) => $q->where('email', 'like', '%'.request()->get('email').'%')
            );
    }
}
