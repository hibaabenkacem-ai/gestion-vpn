<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('notifications_custom', function (Blueprint $table) {
            $table->id(); // idNotification
            $table->string('destinataire'); // email or user identifier
            $table->text('message');
            $table->timestamp('date_envoi')->nullable();
            $table->boolean('sent')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notifications_custom');
    }
};
