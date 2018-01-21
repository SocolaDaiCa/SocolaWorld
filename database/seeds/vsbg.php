<?php

use Illuminate\Database\Seeder;

class vsbg extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$data = [
        	['1710126539287794', 3],
        	['748231438569209', 3],
        	['1958228191101926', 3]
        ];
        foreach ($data as $item) {
        	DB::table('vsbg')->insert([
        		'target_id' => $item[0],
        		'level' => $item[1]
        	]);
        }
    }
}
