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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('goal')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->integer('current_weight')->nullable();
            $table->integer('target_weight')->nullable();
            $table->string('password');

            $table->timestamps();
        });

        Schema::create('exercise_plans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
            ->constrained('users')
            ->onUpdate('cascade')
            ->onDelete('cascade');;
            $table->string('fitness_level');
            $table->json('preferences')->nullable();
            $table->json('health_conditions');
            $table->integer('days_per_week');
            $table->integer('session_duration');
            $table->integer('plan_duration_weeks');

            $table->timestamps();
        });

        Schema::create('nutrition_plans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
            ->constrained('users')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->string('dietary_restrictions');
            $table->string('daily_activity_level');
            $table->timestamps();
        });


        Schema::create('meals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                  ->constrained('users')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
            $table->string('exercise_name');
            $table->string('seo_title')->nullable();
            $table->text('description')->nullable();
            $table->text('goal')->nullable();
            $table->integer('calories_per_day')->nullable();
            $table->json('macronutrients')->nullable();
            $table->json('meal_suggestions')->nullable();
            $table->timestamps();
        });

        Schema::create('exercises', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                  ->constrained('users')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');

            $table->string('day');
            $table->string('name');
            $table->string('duration')->nullable();
            $table->string('repetitions')->nullable();
            $table->string('sets')->nullable();
            $table->string('equipment')->nullable();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exercise_plans');
        Schema::dropIfExists('nutrition_plans');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('exercises');
        Schema::dropIfExists('meals');
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('users');
    }
};
