<?php

namespace App\Traits;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;

trait RecordHelper
{
    public function getUuid()
    {
        return Str::orderedUuid();
    }
}