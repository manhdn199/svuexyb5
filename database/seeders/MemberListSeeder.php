<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MemberListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('memberlist')->insert([
            'user_id' => 2,
            'position_id' => 1,
            'project_id' => 1
        ]);
    }
}
