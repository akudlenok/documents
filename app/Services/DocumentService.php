<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Document;

class DocumentService
{
    public function update(Document $document, array $data): Document
    {
        return tap($document, function (Document $document) use ($data) {
            $document->fill($data);
            $document->save();
        });
    }

    public function delete(Document $document): bool
    {
        $document->load('users');
        return $document->delete();
    }
}
