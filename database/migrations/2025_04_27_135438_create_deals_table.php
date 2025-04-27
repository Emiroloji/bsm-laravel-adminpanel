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
        Schema::create('deals', function (Blueprint $t) {
            $t->id();
            $t->string('title');
            $t->decimal('amount', 15, 2)->nullable();
            $t->enum('stage', ['new','qualified','proposal','negotiation','won','lost'])->default('new');
            $t->date('close_date')->nullable();
            $t->foreignId('company_id')->nullable()->constrained()->nullOnDelete();
            $t->foreignId('contact_id')->nullable()->constrained()->nullOnDelete();
            $t->text('description')->nullable();
            $t->enum('status', ['open','won','lost'])->default('open');
            $t->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deals');
    }
};