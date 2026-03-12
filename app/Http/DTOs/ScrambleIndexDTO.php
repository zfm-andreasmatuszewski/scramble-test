<?php

namespace App\Http\DTOs;

use App\Models\User;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Lazy;

class ScrambleIndexDTO extends Data
{
    public function __construct(
        public string $name,
        public Lazy|string $email,
        public Lazy|UserSettingsDTO $settings,
    ) {}

    public static function fromModel(User $user): self
    {
        return new self(
            $user->name,
            Lazy::create(fn() => $user->email),
            Lazy::create(fn() => UserSettingsDTO::fromModel($user->settings)),
        );
    }
}
