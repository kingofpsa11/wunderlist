<?php

use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tasks')->insert([
            [
                'title' => 'Hom nay',
                'duedate' => '2019-03-28',
                'reminder_date' => '2019-05-17 20:10:00',
                'status' => 1,
                'list_task_id' => 2
            ],
            [
                'title' => 'Ngay kia',
                'duedate' => '2019-04-18',
                'reminder_date' => '2019-04-10 10:00:00',
                'status' => 0,
                'list_task_id' => 2
            ],
            [
                'title' => 'Hom qua',
                'duedate' => '2019-01-28',
                'reminder_date' => '2019-03-17 20:10:00',
                'status' => 1,
                'list_task_id' => 2
            ]
        ]);
    }
}