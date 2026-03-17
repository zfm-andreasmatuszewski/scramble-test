<?php

namespace App\Http\DTOs;

use App\Models\Address;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Lazy;

class AddressDTO extends Data
{
    public function __construct(
        public string $street,
        public string $city,
        public Lazy|string $country,
    ) {}

    public static function fromModel(Address $address): self
    {
        return new self(
            $address->street,
            $address->city,
            Lazy::create(fn() => $address->country),
        );
    }
}
