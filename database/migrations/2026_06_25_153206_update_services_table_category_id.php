<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->foreignId('category_id')->nullable()->constrained('categories')->onDelete('cascade')->after('description');
        });

        $categories = DB::table('categories')->pluck('id', 'slug')->toArray();

        DB::table('services')->orderBy('id')->chunk(100, function ($services) use ($categories) {
            foreach ($services as $service) {
                if (isset($categories[$service->category])) {
                    DB::table('services')->where('id', $service->id)->update([
                        'category_id' => $categories[$service->category]
                    ]);
                }
            }
        });

        Schema::table('services', function (Blueprint $table) {
            $table->dropColumn('category');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->string('category')->nullable()->after('description');
        });

        $categories = DB::table('categories')->pluck('slug', 'id')->toArray();
        DB::table('services')->orderBy('id')->chunk(100, function ($services) use ($categories) {
            foreach ($services as $service) {
                if ($service->category_id && isset($categories[$service->category_id])) {
                    DB::table('services')->where('id', $service->id)->update([
                        'category' => $categories[$service->category_id]
                    ]);
                }
            }
        });

        Schema::table('services', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
            $table->dropColumn('category_id');
        });
    }
};
