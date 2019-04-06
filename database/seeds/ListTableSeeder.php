<?php

use Illuminate\Database\Seeder;

class ListTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('list_tasks')->insert(
            [
                [
                    'id' => 1,
                    'title' => 'Inbox',
                    'user_id' => 1
                ],
                [
                    'id' => 2,
                    'title' => 'Work',
                    'user_id' => 1
                ]
            ]
        );
        
    }
}
