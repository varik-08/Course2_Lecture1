<?php

namespace App\Schedule;

use Illuminate\Support\Facades\Log;

class FlushSchedule
{
    public function __invoke()
    {
        Log::alert("invoke");
    }
}
