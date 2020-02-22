<?php

use Illuminate\Database\Seeder;
use App\Models\ChaletOptions;

class ChaletSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$values = [

    		"دور متكرر بحديقة",
    		"دور ارضى بجنينة",
    		"دور متكرر",
    		"دور أرضى",

    	];

    	foreach ($values as $value) {
    		ChaletOptions::create([

    			'type' => 0,
    			'value' => $value

    		]);
    	}

    	$values = [

    		"70",
    		"80",
    		"90",
    		"100",
    		"120",
    	];

    	foreach ($values as $value) {
    		ChaletOptions::create([

    			'type' => 1,
    			'value' => $value."متر"

    		]);
    	}

    	$values = [

    		"غرفة واحدة",
    		"غرفتين",
    		"ثلاث غرف",

    	];

    	foreach ($values as $value) {
    		ChaletOptions::create([

    			'type' => 2,
    			'value' => $value

    		]);
    	}


    }
}
