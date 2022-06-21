<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class test extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $digits = '23';

        $phoneNumber = [
            2 => 'abc',
            3 => 'def',
            4 => 'ghi',
            5 => 'jkl',
            6 => 'mno',
            7 => 'pqrs',
            8 => 'tuv',
            9 => 'wxyz',
        ];

        $result = [];

        for ($i = 0; $i < strlen($digits); $i++) {
            $result[] = $phoneNumber[$digits[$i]];
        }

        dd($result);

    }

    public function dp($array, $result, $length, $x, $y, $temp)
    {
        if ($x == $length) return true;
        $temp .= $array[$x][$y];
        $this->dp($array, $result, $length, $x + 1, $y, $temp);
        $this->dp($array, $result, $length, $x + 1, $y + 1, $temp);
    }
}
