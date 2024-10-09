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
        Schema::table('users', function (Blueprint $table) {
            $table->string('employee_id')->nullable(); // Employee ID number
            $table->integer('mobile')->nullable();
            $table->integer('extension')->nullable();
            $table->foreignId('section_id')->nullable()->constrained()->nullOnDelete();
            $table->boolean('is_admin')->default(0); // has all permissions and authority system does not apply to him.
            $table->set('type', ["admin","staff","user"])->default('user'); // admin to access admin panel, staff to access staff panel.
            $table->boolean('is_active')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
