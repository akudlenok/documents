<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\DocumentRequest;
use App\Http\Resources\DocumentResource;
use App\Models\Document;
use App\Models\User;
use App\Services\DocumentService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class DocumentController extends Controller
{
    public function __construct(
        private readonly DocumentService $documentService
    )
    {
    }

    public function update(int $id, DocumentRequest $request): DocumentResource
    {
        $user = User::factory()->create();
        auth()->login($user);

        $document = Document::findOrFail($id);
        $document = $this->documentService->update($document, $request->validated());
        return new DocumentResource($document);
    }

    public function destroy(int $id): JsonResponse
    {
        $document = Document::findOrFail($id);
        $deleteResult = $this->documentService->delete($document);
        return new JsonResponse([], $deleteResult ? Response::HTTP_NO_CONTENT : Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
