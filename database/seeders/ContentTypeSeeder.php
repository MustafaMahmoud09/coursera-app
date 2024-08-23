<?php

namespace Database\Seeders;

use App\Models\ContentType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //array contain on types
        $types = [
            'video',
            'assignment'
        ];

        //store types in db
        foreach ($types as $type) {
            ContentType::create(
                [
                    'type' => $type
                ]
            );
        } //end foreach

    } //end run

}//end ContentTypeSeeder
