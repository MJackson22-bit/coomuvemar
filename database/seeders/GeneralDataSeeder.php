<?php

namespace Database\Seeders;

use App\Models\GeneralData;
use Illuminate\Database\Seeder;

class GeneralDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $generalData = GeneralData::factory(50)->make();
        foreach ($generalData as $item) {
            $item->save();
        }
    }
}
