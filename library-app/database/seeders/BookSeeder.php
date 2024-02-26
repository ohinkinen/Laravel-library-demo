<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('books')->insert([
            ['title' => 'The Republic'],
            ['title' => 'The Communist Manifesto'],
            ['title' => 'The Rights of Man'],
            ['title' => 'Common Sense'],
            ['title' => 'Democracy in America'],
            ['title' => 'The Prince'],
            ['title' => 'Narrative of the life of Frederick Douglass, an American Slave'],
            ['title' => 'On Liberty'],
            ['title' => 'The Wealth of Nations'],
            ['title' => 'Orientalism'],
            ['title' => 'The Canterbury Tales'],
            ['title' => 'Divine Comedy'],
        ]);
    }
}
