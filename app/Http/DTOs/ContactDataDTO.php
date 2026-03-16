<?php

namespace App\Http\DTOs;

use App\Models\Contact;
use Illuminate\Support\Collection;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Lazy;

class ContactDataDTO extends Data
{
    public function __construct(
        public string $first_name,
        public string $last_name,
        public ?string $email,
        #[DataCollectionOf(AddressDTO::class)]
        public Lazy|Collection $addresses,
    ) {}

    public static function fromModel(Contact $contact): self
    {
        return new self(
            $contact->first_name,
            $contact->last_name,
            $contact->email,
            Lazy::create(fn() => $contact->addresses),
        );
    }
}
