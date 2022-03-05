<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RecordType;

class RecordTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'Food & Drink',
                'description' => 'Expenses from food and drinks.',
                'offset' => 'expense'
            ],
            [
                'name' => 'Salary & Wages',
                'description' => 'Salary from employment.',
                'offset' => 'income'
            ],
            [
                'name' => 'Transfer to Other Account',
                'description' => 'Transfer to other account.',
                'offset' => 'transfer'
            ]
        ];
        
        collect($data)->map(static function ($value) {
            RecordType::create($value);
        });
    }
}
