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
        Schema::table('orders', function (Blueprint $table) {
            $table->string("first_name",100);
            $table->string("last_name",100);
            $table->string("city",100);
            $table->string("telephone",30);
            $table->string("email",100);
            $table->string("order_note")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(["order_note","email",'telephone','city','last_name','first_name']);
        });
    }
};
