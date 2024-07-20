<?php

namespace App\Repositories;

use Illuminate\Support\Collection;

interface DestinationRepositoryInterface
{
    public function getDestinations(): Collection|\Illuminate\Database\Eloquent\Collection;
}
