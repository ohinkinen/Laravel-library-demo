<?php

namespace Database\Seeders;

use App\Models\Library;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookLibrarySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $libraries = Library::all();

        foreach ($libraries as $library) {
            $randIds = [];
            while(count($randIds) < 5) {
                $randIds[] = rand(1, 12);
                $randIds = array_unique($randIds);
            }

            $library->books()->attach($randIds);
        }
    }
}
