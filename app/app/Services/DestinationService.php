<?php

namespace App\Services;

use App\Entities\DestinationEntity;
use App\Repositories\DestinationRepositoryInterface;
use Illuminate\Support\Collection;

final readonly class DestinationService
{
    public function __construct(
        private DestinationRepositoryInterface $destinationRepository,
        private int $earthRadius,
    ) {
    }

    public function getDestinationsWithinRadius(string $destinationName, int $findInRadius): Collection
    {
        $destinations = $this->destinationRepository->getDestinations();
        /** @var DestinationEntity $fromCity */
        $fromCity = $destinations->firstWhere(
            fn(DestinationEntity $destinationEntity) => $destinationEntity->getName() === $destinationName
        );

        if (!$fromCity) {
            return collect();
        }

        $fromCityLat = deg2rad($fromCity->getLat());
        $fromCityLon = deg2rad($fromCity->getLot());

        return $destinations->map(function (DestinationEntity $toCity) use (
            $fromCity,
            $fromCityLat,
            $fromCityLon,
            $findInRadius
        ) {
            $distance = $this->calculateDistance($fromCityLat, $fromCityLon, $toCity);

            if (
                $fromCity->getId() === $toCity->getId()
                ||
                $distance > $findInRadius
            ) {
                return null;
            }

            return [
                'id' => $toCity->getId(),
                'name' => $toCity->getName(),
                'distance' => $distance,
            ];
        })->filter()->sortBy('distance')->values();
    }

    protected function calculateDistance(float $fromCityLat, float $fromCityLon, DestinationEntity $toCity): float
    {
        $earthRadius = $this->earthRadius;
        $toCityLat = deg2rad($toCity->getLat());
        $toCityLon = deg2rad($toCity->getLot());

        $dLat = $toCityLat - $fromCityLat;
        $dLon = $toCityLon - $fromCityLon;

        $haversineFormula = sin($dLat / 2) * sin($dLat / 2) +
            cos($fromCityLat) * cos($toCityLat) *
            sin($dLon / 2) * sin($dLon / 2);
        return $earthRadius * (2 * atan2(sqrt($haversineFormula), sqrt(1 - $haversineFormula)));
    }
}
