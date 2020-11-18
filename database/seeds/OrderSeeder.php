<?php

use Illuminate\Database\Seeder;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Http\Models\Order;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Order::create([
            'name' => 'João Víctor',
            'email' => Str::random(3) . '@gmail.com',
            'document' => Str::random(3) . '.000.000-' . Str::random(2),
            'birth_date' => '2017-06-15',
            'phone' => '51 9 ' . Str::random(9),
            'genre' => 'M',
            'profession' => 'Engenheiro',
            'monthly_income' => '1900',
            'mother_name' => 'Julia Pereira',
            'dad_name' => 'Lucas Souza',
            'nationality' => 'BR',
            'status' => 'approved',
            'address' => [
                'zipcode' => '9999-9999',
                'state' => 'SP',
                'city' => 'Indaiatuba',
                'street' => 'Rua dos gu',
                'number' => '295'
            ]
        ]);

        Order::create([
            'name' => 'Luisa Sounza',
            'email' => Str::random(3) . '@gmail.com',
            'document' => Str::random(3) . '.000.000-' . Str::random(2),
            'birth_date' => '2017-06-15',
            'phone' => '51 9 ' . Str::random(9),
            'genre' => 'F',
            'profession' => 'Professora',
            'monthly_income' => '1900',
            'mother_name' => 'Andreia Souza',
            'dad_name' => 'Kevin Silva',
            'nationality' => 'BR',
            'status' => 'denied',
            'address' => [
                'zipcode' => '9999-9999',
                'state' => 'SP',
                'city' => 'Indaiatuba',
                'street' => 'Rua dos gu',
                'number' => '295'
            ]
        ]);

        Order::create([
            'name' => 'Luisa Sounza',
            'email' => Str::random(3) . '@gmail.com',
            'document' => Str::random(3) . '.000.000-' . Str::random(2),
            'birth_date' => '2017-06-15',
            'phone' => '51 9 ' . Str::random(9),
            'genre' => 'F',
            'profession' => 'Professora',
            'monthly_income' => '1900',
            'mother_name' => 'Andreia Souza',
            'dad_name' => 'Kevin Silva',
            'nationality' => 'BR',
            'status' => 'denied',
            'address' => [
                'zipcode' => '9999-9999',
                'state' => 'SP',
                'city' => 'Indaiatuba',
                'street' => 'Rua dos gu',
                'number' => '295'
            ]
        ]);
    }
}
