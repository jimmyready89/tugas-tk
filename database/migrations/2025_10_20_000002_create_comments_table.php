<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id('comment_id');
            $table->string('comment_tag')->unique();
            $table->unsignedBigInteger('news_id')->index();
            $table->string('news_tag')->index();
            $table->text('comment');
            $table->string('comment_by');
            $table->boolean('is_visible')->default(true);
            $table->timestamps();
            
            $table->foreign('news_id')->references('news_id')->on('news')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
