<?php

namespace App\Schedule;

use Illuminate\Support\Facades\Cache;

class FlushSchedule
{
    public function __invoke()
    {
        Cache::flush();
    }
}
