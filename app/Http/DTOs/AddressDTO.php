<?php

namespace App\Http\DTOs;

use App\Models\Address;
use Spatie\LaravelData\Data;

class AddressDTO extends Data
{
    public function __construct(
        public string $street,
        public string $city,
        public string $country,
    ) {}

    public static function fromModel(Address $address): self
    {
        return new self(
            $address->street,
            $address->city,
            $address->country,
        );
    }
}
