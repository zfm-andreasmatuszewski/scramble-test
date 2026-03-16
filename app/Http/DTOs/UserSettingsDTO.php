<?php

namespace App\Http\DTOs;

use App\Models\UserSetting;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Lazy;

class UserSettingsDTO extends Data
{
    public function __construct(
        public bool $sidebar_collapsed,
        public Lazy|bool $email_notifications_activated,
    ) {
    }

    public static function fromModel(UserSetting $settings): self
    {
        return new self(
            sidebar_collapsed: $settings->sidebar_collapsed,
            email_notifications_activated: $settings->email_notifications_activated,
        );
    }
}