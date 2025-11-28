<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $categories = [
            'Indian Politician',
            'Marathi Wedding Calligraphy',
            'Hindu Religious Calligraphy',
            'Historical / Warrior',
            'Events & Greeting',
            'Signature & Calligraphy Names',
            'Food / Restaurant',
        ];

        foreach ($categories as $category) {
            DB::table('categories')->insert([
                'name' => $category,
                'slug' => Str::slug($category),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $slugs = [
            'indian-politician',
            'marathi-wedding-calligraphy',
            'hindu-religious-calligraphy',
            'historical-warrior',
            'events-greeting',
            'signature-calligraphy-names',
            'food-restaurant',
        ];

        DB::table('categories')->whereIn('slug', $slugs)->delete();
    }
};
