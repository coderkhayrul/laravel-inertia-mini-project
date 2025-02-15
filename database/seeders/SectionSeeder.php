<?php

namespace Database\Seeders;

use App\Models\Classes;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sections = [
            'Section A',
            'Section B',
            'Section C',
        ];

        $classes = Classes::all();

        // Each Class has Random 2 Section Selected
        foreach ($classes as $class) {
            $randomSections = collect($sections)->random(2);

            foreach ($randomSections as $section) {
                $class->sections()->create(['name' => $section]);
            }
        }
    }
}
