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
        Schema::create('companies', function (Blueprint $t) {
            $t->id();

            $t->string('name');                          // zorunlu
            $t->string('legal_name')->nullable();        // ticari unvan
            $t->string('tax_number')->nullable();        // vergi no / TCKN
            $t->string('phone')->nullable();
            $t->string('email')->nullable()->unique();
            $t->string('website')->nullable();
            $t->string('industry')->nullable();
            $t->enum('size', ['small','medium','enterprise'])->nullable();
            $t->text('address')->nullable();
            $t->text('notes')->nullable();

            $t->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};