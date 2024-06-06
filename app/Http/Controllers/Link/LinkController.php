<?php

namespace App\Http\Controllers\Link;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateLinkShortedRequest;
use App\Services\Link\LinkServiceImplement;
use Illuminate\Http\JsonResponse;

class LinkController extends Controller
{
    public function __construct(
        protected LinkServiceImplement $linkService
    ) {
    }

    public function createLinkShorted(CreateLinkShortedRequest $request): JsonResponse
    {
        return $this->linkService->createLinkShorted($request->validated());
    }
}
