<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('comments_posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('comment_id')->index()->nullable()->constrained('comments');
            $table->foreignId('post_id')->index()->nullable()->constrained('posts');
            $table->unique(['comment_id', 'post_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments_posts');
    }
};
