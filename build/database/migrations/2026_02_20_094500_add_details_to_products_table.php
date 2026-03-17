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
        Schema::table('products', function (Blueprint $table) {
            $table->text('tasting_notes')->nullable()->after('description');
            $table->string('brand')->nullable()->after('name');
            $table->decimal('alcohol_percentage', 5, 2)->nullable()->after('price');
            $table->string('country')->nullable()->after('brand');
            $table->boolean('is_staff_pick')->default(false)->after('is_featured');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['tasting_notes', 'brand', 'alcohol_percentage', 'country', 'is_staff_pick']);
        });
    }
};
