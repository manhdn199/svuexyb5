<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Project extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('projects')->insert([
            'name' => 'PHP-Fresher',
            'detail' => 'Project by fresher',
            'duration' => '160',
            'revenue' => '0',
            'memberList' => 'manhnd DEV manhnd1 TEST'
        ]);

    }
}
