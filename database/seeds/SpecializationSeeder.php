<?php

use Illuminate\Database\Seeder;
use App\Models\Specialization;

class SpecializationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $specs = config('specializations');
        
        foreach($specs as $spec){

            $new_spec = new Specialization();

            $new_spec->label = $spec['label'];
            $new_spec->color = $spec['color'];

            $new_spec->save();
        }
    }
}
