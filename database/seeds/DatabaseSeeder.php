<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('list_tasks')->insert(
            [
                [
                    'title' => 'Inbox',
                    'user_id' => 1
                ],
                [
                    'title' => 'Work',
                    'user_id' => 1
                ]
            ]
        );
    }
}
