<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ExamsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $exam = new \App\Exam([
            'code' => '111111',
            'name' => 'aaaaaa',
            'start_time' => '2019-11-23 09:00:00',
            'end_time' => '2019-11-23 12:00:00'
        ]);
        $exam->save();

        $exam = new \App\Exam([
            'code' => '111112',
            'name' => 'baaaaa',
            'start_time' => '2019-11-24 09:00:00',
            'end_time' => '2019-11-24 12:00:00'
        ]);
        $exam->save();

        $exam = new \App\Exam([
            'code' => '111122',
            'name' => 'bbaaaa',
            'start_time' => '2019-11-25 09:00:00',
            'end_time' => '2019-11-25 12:00:00'
        ]);
        $exam->save();

        $exam = new \App\Exam([
            'code' => '111222',
            'name' => 'bbbaaa',
            'start_time' => '2019-11-26 09:00:00',
            'end_time' => '2019-11-26 12:00:00'
        ]);
        $exam->save();

        $exam = new \App\Exam([
            'code' => '112222',
            'name' => 'bbbbaa',
            'start_time' => '2019-11-27 09:00:00',
            'end_time' => '2019-11-27 12:00:00'
        ]);
        $exam->save();

        $exam = new \App\Exam([
            'code' => Str::random(8),
            'name' => Str::random(10),
            'start_time' => '2019-11-23 09:00:00',
            'end_time' => '2019-11-23 12:00:00'
        ]);
        $exam->save();

        $exam = new \App\Exam([
            'code' => Str::random(8),
            'name' => Str::random(10),
            'start_time' => '2019-11-24 09:00:00',
            'end_time' => '2019-11-24 12:00:00'
        ]);
        $exam->save();

        $exam = new \App\Exam([
            'code' => Str::random(8),
            'name' => Str::random(10),
            'start_time' => '2019-11-25 09:00:00',
            'end_time' => '2019-11-25 12:00:00'
        ]);
        $exam->save();

        $exam = new \App\Exam([
            'code' => Str::random(8),
            'name' => Str::random(10),
            'start_time' => '2019-11-26 09:00:00',
            'end_time' => '2019-11-26 12:00:00'
        ]);
        $exam->save();

        $exam = new \App\Exam([
            'code' => Str::random(8),
            'name' => Str::random(10),
            'start_time' => '2019-11-27 09:00:00',
            'end_time' => '2019-11-27 12:00:00'
        ]);
        $exam->save();
    }
}
