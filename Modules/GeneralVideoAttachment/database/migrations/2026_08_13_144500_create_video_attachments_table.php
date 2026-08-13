<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('video_attachments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->nullable()->constrained('patients');
            $table->foreignId('visit_id')->nullable()->constrained('visits');
            $table->string('title');
            $table->string('file_path');
            $table->string('mime_type')->nullable();
            $table->integer('duration_seconds')->nullable();
            $table->foreignId('recorded_by')->nullable()->constrained('users');
            $table->text('notes')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('video_attachments');
    }
};
