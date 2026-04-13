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
            $table->string('mobile_number')->nullable()->after('email');
            $table->string('gender')->nullable()->after('mobile_number');
            $table->string('role')->nullable()->after('gender');
            $table->date('date_of_birth')->nullable()->after('role');
            $table->text('address')->nullable()->after('date_of_birth');
            $table->string('profile_photo')->nullable()->after('address');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'mobile_number',
                'gender',
                'role',
                'date_of_birth',
                'address',
                'profile_photo'
            ]);
        });
    }
};