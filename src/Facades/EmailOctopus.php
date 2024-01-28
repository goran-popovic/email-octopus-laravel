<?php

declare(strict_types=1);

namespace GoranPopovic\EmailOctopus\Facades;

use GoranPopovic\EmailOctopus\Resources\Automations;
use GoranPopovic\EmailOctopus\Resources\Campaigns;
use GoranPopovic\EmailOctopus\Resources\Lists;
use Illuminate\Support\Facades\Facade;

final class EmailOctopus extends Facade
{
    /**
     * @method static Automations automations()
     * @method static Lists lists()
     * @method static Campaigns campaigns()
     */
    protected static function getFacadeAccessor(): string
    {
        return 'email.octopus';
    }
}
