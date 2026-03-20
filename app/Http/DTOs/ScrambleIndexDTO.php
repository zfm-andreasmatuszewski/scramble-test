<?php

namespace App\Http\DTOs;

use App\Models\User;
use Illuminate\Support\Collection;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Lazy;

class ScrambleIndexDTO extends Data
{
    public function __construct(
        public string $name,
        public string $email,
        public Lazy|UserSettingsDTO|null $settings,
        #[DataCollectionOf(ContactDataDTO::class)]
        public Lazy|Collection $contacts,
    ) {}

    public static function fromModel(User $user): self
    {
        return new self(
            $user->name,
            $user->email,
            Lazy::create(fn() => $user->settings !== null ? UserSettingsDTO::fromModel($user->settings) : null),
            Lazy::create(fn() => $user->contacts->map(fn($contact) => ContactDataDTO::fromModel($contact))),
        );
    }
}
