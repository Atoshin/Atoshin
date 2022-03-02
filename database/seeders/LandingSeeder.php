<?php

namespace Database\Seeders;

use App\Models\Landing;
use Illuminate\Database\Seeder;

class LandingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $landing = Landing::query()->create([
            'text' => 'Increase Access And Enable New Communities',

        ]);

    }
}
