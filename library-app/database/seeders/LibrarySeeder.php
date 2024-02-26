<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LibrarySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('libraries')->insert([
            ['name' => 'Library of Congress'],
            ['name' => 'Bodleian Library'],
            ['name' => 'Vatican Library'],
            ['name' => 'National Library of St. Mark\'s'],
            ['name' => 'Boston Public Library'],
            ['name' => 'Library of Parliament'],
            ['name' => 'New York Public Library'],
            ['name' => 'Thomas Fisher Rare Book Library'],
            ['name' => 'Seattle Central Library'],
            ['name' => 'Abbey Library of Saint Gall'],
            ['name' => 'Austrian National Library'],
            ['name' => 'National Library of Sweden'],
            ['name' => 'Library of the Benedictine Monastery'],
            ['name' => 'The Morgan Library'],
        ]);
    }
}
