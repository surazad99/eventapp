<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::statement('TRUNCATE events;');
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        $events = [
            [
                'user_id' => 1,
                'title' => 'Finance Seminar',
                'description' => 'Finance seminar coming next week plan for its celebration',
                'start_date' => '2023/01/01',
                'end_date' => '2023/01/10'
            ],
            [
                'user_id' => 1,
                'title' => 'Attend Summer Classes',
                'description' => 'Summer classes next month',
                'start_date' => '2023/01/03',
                'end_date' => '2023/02/03'
            ],
            [
                'user_id' => 1,
                'title' => 'Vacation',
                'description' => 'vacation for some days',
                'start_date' => '2023/02/01',
                'end_date' => '2023/02/10'
            ],
            [
                'user_id' => 1,
                'title' => 'Appoinments',
                'description' => 'Attend all the appointments',
                'start_date' => '2023/02/03',
                'end_date' => '2023/02/17'
            ],
            [
                'user_id' => 1,
                'title' => 'Buy groceries',
                'description' => 'Buy some groceries',
                'start_date' => '2023/02/02',
                'end_date' => '2023/02/10'
            ],
            [
                'user_id' => 1,
                'title' => 'Send Notifications',
                'description' => 'Send notifications to all the users',
                'start_date' => '2023/01/11',
                'end_date' => '2023/01/19'
            ],
        ];

        DB::table('events')->insert($events);
    }
}
