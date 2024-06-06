<?php

namespace App\Services\Link;

use Illuminate\Http\JsonResponse;
use LaravelEasyRepository\BaseService;

interface LinkService extends BaseService
{
    public function createLinkShorted(array $data): JsonResponse;
}
