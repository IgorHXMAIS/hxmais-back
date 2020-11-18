<?php

use Illuminate\Database\Seeder;

use App\Http\Models\Admin;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
            'name' => 'Jhon Doe',
            'email' => Str::random(5) . '@gmail.com',
            'password' => Hash::make('123456')
        ]);
    }
}
