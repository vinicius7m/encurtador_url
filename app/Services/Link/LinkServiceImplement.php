<?php

namespace App\Services\Link;

use App\Repositories\Link\LinkRepositoryImplement;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use LaravelEasyRepository\Service;
use Throwable;

class LinkServiceImplement extends Service implements LinkService
{
    public function __construct(
        protected LinkRepositoryImplement $linkRepository
    ) {
    }

    public function createLinkShorted(array $data): JsonResponse
    {
        DB::beginTransaction();

        try {
            $shortLink = uniqid();

            $dataCreateLink = [
                'link_received' => $data['link'],
                'link_shorted' => $shortLink,
                'name' => $data['name'] ?? null,
            ];

            $data = $this->linkRepository->createLink($dataCreateLink);

            DB::commit();

            return response()->json(['success' => true, 'data' => $data], 200, [], JSON_UNESCAPED_SLASHES);
        } catch (Throwable $th) {
            DB::rollBack();

            return response()->json(['success' => false, 'message' => 'Internal error'.$th]);
        }
    }
}
