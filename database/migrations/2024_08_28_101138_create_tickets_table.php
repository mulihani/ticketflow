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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->ipAddress('author_ip')->nullable();
            $table->string('author_id')->nullable();
            $table->string('author_name');
            $table->string('author_mobile')->nullable();
            $table->string('author_ext')->nullable();
            $table->foreignId('category_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('section_id')->nullable()->constrained()->nullOnDelete();
            $table->longText('content')->nullable();
            $table->longText('note')->nullable();
            $table->foreignId('user_id')->nullable();
            $table->set('status', ["open","closed","processing"])->default('open');
            $table->foreignId('staff_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
