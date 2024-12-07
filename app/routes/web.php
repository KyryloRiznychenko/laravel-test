<?php

use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;

Route::fallback(fn() => throw new JsonException('Invalid Route!', Response::HTTP_NOT_FOUND));
