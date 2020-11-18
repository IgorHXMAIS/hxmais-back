<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Http\Models\Church;
use App\Http\Models\Representative;

class RepresentativeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Representative::create([
            'church_id' => '2',
            'name' => Str::random(5),
            'email' => Str::random(5) . '@gmail.com',
            'password' => Hash::make('123456')
        ]);

        Representative::create([
            'church_id' => '1',
            'name' => Str::random(5),
            'email' => Str::random(5) . '@gmail.com',
            'password' => Hash::make('123456')
        ]);
    }
}
