<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('change_histories', function (Blueprint $table) {
            $table->id();
            $table->string('entity_type')->comment('Изменяемая модель');
            $table->unsignedInteger('entity_id')->comment('Ид модели');
            $table->foreignIdFor(User::class)
                ->comment('Ид пользователя')
                ->constrained();
            $table->string('column')->comment('Изменяемый столбец');
            $table->longText('value')->comment('Старое значение');
            $table->index(['entity_type', 'entity_id']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('change_histories');
    }
};
