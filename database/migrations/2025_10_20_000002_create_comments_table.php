<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id('comment_id'); // auto increment primary key
            $table->string('comment_tag')->unique();
            $table->unsignedBigInteger('news_id')->index(); // Reference to news by news_id
            $table->string('news_tag')->index(); // Keep for backward compatibility
            $table->text('comment');
            $table->string('comment_by');
            $table->boolean('is_visible')->default(true);
            $table->timestamps();
            
            // Foreign key constraint
            $table->foreign('news_id')->references('news_id')->on('news')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
