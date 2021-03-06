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

namespace Cog\Flag\Traits\Inverse;

use Cog\Flag\Scopes\Inverse\DraftedFlagScope;

trait HasDraftedFlagScope
{
    /**
     * Boot the HasDraftedFlagScope trait for a model.
     *
     * @return void
     */
    public static function bootHasDraftedFlagScope(): void
    {
        static::addGlobalScope(new DraftedFlagScope());
    }
}
