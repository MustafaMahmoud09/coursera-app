<?php

namespace Database\Seeders;

use App\Models\Profession;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProfessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $professions = [
            'developer',
            'desginer',
            'musician',
            'biologist',
            'teacher',
            'engineer',
            'lawyer',
            'accountant',
            'doctor',
            'journalist',
            'photographer'
        ];

        foreach ($professions as $profession) {
            Profession::create(
                [
                    'profession' => $profession
                ]
            );
        } //end foreach

    } //end run

}//end ProfessionSeeder
