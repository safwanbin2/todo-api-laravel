<?php

namespace Database\Seeders;

use App\Models\TodoModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TodoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TodoModel::create([
            'title' => 'This is seeded todo'
        ]);
    }
}
