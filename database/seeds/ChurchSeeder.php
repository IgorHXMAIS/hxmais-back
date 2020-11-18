<?php

use Illuminate\Database\Seeder;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Http\Models\Church;

class ChurchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Church::create([
            'name' => Str::random(5),
            'state' => 'RJ',
            'city' => 'São gançalo'
        ]);

        Church::create([
            'name' => Str::random(5),
            'state' => 'RS',
            'city' => 'Niterói'
        ]);
    }
}
