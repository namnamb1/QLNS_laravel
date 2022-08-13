<?php

use Illuminate\Database\Seeder;

class LeaveMemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\MemberLeave::class, 500)->create();
    }
}
