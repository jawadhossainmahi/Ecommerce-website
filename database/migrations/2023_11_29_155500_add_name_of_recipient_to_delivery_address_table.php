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
        Schema::table('delivery_address', function (Blueprint $table) {
            $table->string('name_of_recipient')->nullable();
            $table->string('organization')->nullable();
            $table->string('invoice_email')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('delivery_address', function (Blueprint $table) {
            $table->dropColumn('name_of_recipient');
            $table->dropColumn('organization');
            $table->dropColumn('invoice_email');
        });
    }
};
