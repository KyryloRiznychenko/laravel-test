<?php

namespace App\Repositories;

use App\Entities\DestinationEntity;
use Exception;
use Illuminate\Support\Collection;
use JsonException;
use League\Csv\Reader;

class CsvDestinationRepository implements DestinationRepositoryInterface
{
    private Collection $destinations;

    /**
     * @throws JsonException
     */
    public function __construct(private readonly string $filePath)
    {
        if (!file_exists($filePath)) {
            throw new JsonException('Csv file does not exist');
        }

        $this->pullDestinations();
    }

    /**
     * @throws JsonException
     */
    private function pullDestinations(): void
    {
        try {
            $reader = Reader::createFromPath($this->filePath);
            $reader->setHeaderOffset(0);
            $this->destinations = collect($reader->getRecords())->map(fn($destination) => new DestinationEntity(
                (int) $destination['id'],
                (string) $destination['name'],
                (float) $destination['lat'],
                (float) $destination['lon'],
            ));
        } catch (Exception $e) {
            throw new JsonException('Cannot read the csv repository');
        }
    }

    public function getDestinations(): Collection
    {
        return $this->destinations;
    }
}
