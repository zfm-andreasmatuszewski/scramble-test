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
        public Collection $addresses,
        #[DataCollectionOf(ContactDataDTO::class)]
        public Lazy|Collection $contacts,
    ) {}

    public static function fromModel(Contact $contact): self
    {
        return new self(
            $contact->first_name,
            $contact->last_name,
            $contact->email,
            $contact->addresses,
            Lazy::whenLoaded('contacts', $contact, fn() => $contact->contacts->map(fn($related_contact) => ContactDataDTO::fromModel($related_contact)))
        );
    }
}
