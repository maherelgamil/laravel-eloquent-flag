<?php

/*
 * This file is part of Laravel Eloquent Flag.
 *
 * (c) Anton Komarev <a.komarev@cybercog.su>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Cog\Tests\Flag\Unit\Scopes\Inverse;

use Cog\Tests\Flag\Stubs\Models\Inverse\EntityWithArchivedAt;
use Cog\Tests\Flag\Stubs\Models\Inverse\EntityWithArchivedAtUnapplied;
use Cog\Tests\Flag\TestCase;
use Illuminate\Support\Facades\Date;

final class ArchivedAtScopeTest extends TestCase
{
    /** @test */
    public function it_can_get_only_not_archived(): void
    {
        factory(EntityWithArchivedAt::class, 2)->create([
            'archived_at' => Date::now()->subDay(),
        ]);
        factory(EntityWithArchivedAt::class, 3)->create([
            'archived_at' => null,
        ]);

        $entities = EntityWithArchivedAt::all();

        $this->assertCount(3, $entities);
    }

    /** @test */
    public function it_can_get_without_archived(): void
    {
        factory(EntityWithArchivedAt::class, 2)->create([
            'archived_at' => Date::now()->subDay(),
        ]);
        factory(EntityWithArchivedAt::class, 3)->create([
            'archived_at' => null,
        ]);

        $entities = EntityWithArchivedAt::withoutArchived()->get();

        $this->assertCount(3, $entities);
    }

    /** @test */
    public function it_can_get_with_archived(): void
    {
        factory(EntityWithArchivedAt::class, 2)->create([
            'archived_at' => Date::now()->subDay(),
        ]);
        factory(EntityWithArchivedAt::class, 3)->create([
            'archived_at' => null,
        ]);

        $entities = EntityWithArchivedAt::withArchived()->get();

        $this->assertCount(5, $entities);
    }

    /** @test */
    public function it_can_get_only_archived(): void
    {
        factory(EntityWithArchivedAt::class, 2)->create([
            'archived_at' => Date::now()->subDay(),
        ]);
        factory(EntityWithArchivedAt::class, 3)->create([
            'archived_at' => null,
        ]);

        $entities = EntityWithArchivedAt::onlyArchived()->get();

        $this->assertCount(2, $entities);
    }

    /** @test */
    public function it_can_unarchive_model(): void
    {
        $model = factory(EntityWithArchivedAt::class)->create([
            'archived_at' => Date::now()->subDay(),
        ]);

        EntityWithArchivedAt::where('id', $model->id)->unarchive();

        $model = EntityWithArchivedAt::where('id', $model->id)->first();

        $this->assertNull($model->archived_at);
    }

    /** @test */
    public function it_can_archive_model(): void
    {
        $model = factory(EntityWithArchivedAt::class)->create([
            'archived_at' => null,
        ]);

        EntityWithArchivedAt::where('id', $model->id)->archive();

        $model = EntityWithArchivedAt::withArchived()->where('id', $model->id)->first();

        $this->assertNotNull($model->archived_at);
    }

    /** @test */
    public function it_can_skip_apply(): void
    {
        factory(EntityWithArchivedAt::class, 3)->create([
            'archived_at' => Date::now()->subDay(),
        ]);
        factory(EntityWithArchivedAt::class, 2)->create([
            'archived_at' => null,
        ]);

        $entities = EntityWithArchivedAtUnapplied::all();

        $this->assertCount(5, $entities);
    }
}
