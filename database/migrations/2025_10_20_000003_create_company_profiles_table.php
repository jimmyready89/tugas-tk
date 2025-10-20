<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('company_profiles', function (Blueprint $table) {
            $table->id('company_profile_id'); // auto increment primary key
            $table->string('comp_name');
            $table->text('comp_description')->nullable();
            $table->string('comp_email')->nullable();
            $table->string('comp_telephone')->nullable();
            $table->text('comp_address')->nullable();
            $table->text('vision')->nullable();
            $table->text('mission')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('company_profiles');
    }
};
