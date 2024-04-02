<?php

use App\Models\Document;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('document_user', function (Blueprint $table) {
            $table->foreignIdFor(Document::class)
                ->comment('Ид документа')
                ->constrained()
                ->cascadeOnDelete();
            $table->foreignIdFor(User::class)
                ->comment('Ид пользователя')
                ->constrained()
                ->cascadeOnDelete();
        });
    }

    public function down()
    {
        Schema::dropIfExists('document_user');
    }
};
