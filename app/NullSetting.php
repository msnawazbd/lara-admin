<?php

namespace App;

use App\Models\Setting;

class NullSetting extends Setting
{
    protected $attributes = [
        'site_name' => 'Default site title',
        'site_email' => 'mail@mail.com',
        'site_title' => 'Default site name',
        'footer_text' => 'Default footer text',
        'sidebar_collapse' => false,
    ];
}
