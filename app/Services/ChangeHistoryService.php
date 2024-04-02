<?php

declare(strict_types=1);

namespace App\Services;

use App;
use App\Models\ChangeHistory;

class ChangeHistoryService
{
    public function create(string $entityType, int $entityId, string $column, string $value, int $userId = null): ChangeHistory
    {
        $item = new ChangeHistory();
        $item->entity_type = $entityType;
        $item->entity_id = $entityId;
        $item->column = $column;
        $item->value = $value;
        $item->user_id = $userId ?: auth()->id();
        $item->save();
        return $item;
    }
}
