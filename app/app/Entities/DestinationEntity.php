<?php

namespace App\Entities;

final readonly class DestinationEntity
{
    public function __construct(
        private int $id,
        private string $name,
        private float $lat,
        private float $lot,
    ) {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getLat(): float
    {
        return $this->lat;
    }

    public function getLot(): float
    {
        return $this->lot;
    }
}
