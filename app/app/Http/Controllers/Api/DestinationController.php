<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Destinations\FindDestinationsInRadiusRequest;
use App\Http\Resources\Api\Destinations\FindDestinationInRadiusResourceCollection;
use App\Services\DestinationService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use JsonException;
use Symfony\Component\HttpFoundation\Response;

class DestinationController extends Controller
{
    public function __construct(private readonly DestinationService $service)
    {
    }

    /**
     * @throws JsonException
     */
    public function __invoke(FindDestinationsInRadiusRequest $request): AnonymousResourceCollection
    {
        $inputData = $request->validated();
        $destinations = $this->service->getDestinationsWithinRadius($inputData['name'], $inputData['radius']);
        
        return FindDestinationInRadiusResourceCollection::collection($destinations);
    }
}
