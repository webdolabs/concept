<?php

namespace App\Actions\System;

use App\Models\SystemOption;

trait UpdateSystemOptions
{
    public function updateSystemOptions($options)
    {
        foreach($options as $key => $value) {
            $this->updateSystemOption($key, $value);
        }
    }

    public function updateSystemOption($name, $value)
    {
        SystemOption::updateOrCreate(
            ['name' => $name],
            ['value' => $value]
        );
    }
}