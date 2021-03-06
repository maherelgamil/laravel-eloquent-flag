<?php

/*
 * This file is part of Laravel Eloquent Flag.
 *
 * (c) Anton Komarev <anton@komarev.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Cog\Flag\Traits\Classic;

use Cog\Flag\Scopes\Classic\VerifiedFlagScope;

trait HasVerifiedFlagScope
{
    /**
     * Boot the HasVerifiedFlagScope for a model.
     *
     * @return void
     */
    public static function bootHasVerifiedFlagScope(): void
    {
        static::addGlobalScope(new VerifiedFlagScope());
    }
}
