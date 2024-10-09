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
        Schema::disableForeignKeyConstraints();

        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('site_name', 255)->default('Ticket Flow');
            $table->string('site_email', 255)->nullable();
            $table->boolean('signup_status')->default(1);
            $table->boolean('users_only_status')->default(1); // Make the system available to registered users only
            $table->boolean('site_status')->default(1);
            $table->text('site_close_massage')->nullable();
            $table->json('closed_days'); // Close the system on specific days.
            $table->boolean('site_activation_hours')->default(0); // Allow the system to operate according to specific hours.
            $table->text('site_activation_hours_massage')->nullable();
            $table->time('site_activation_starts_at')->default('07:00:00');
            $table->time('site_activation_ends_at')->default('17:00:00');
            $table->string('it_support_number', 255)->nullable();
            $table->longText('support_info_page')->nullable();
            $table->boolean('support_info_page_status')->default(1);
            $table->boolean('ticket_search_status')->default(1);
            $table->string('timezone')->default('UTC');
            $table->boolean('ticket_monitor_status')->default(1);
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
