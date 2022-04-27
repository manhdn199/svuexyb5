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
        DB::table('memberList')->insert([
            'user_id' => 3,
            'position_id' => 3,
            'project_id' => 1
        ]);
    }
}
