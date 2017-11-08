<?php

use App\Models\Canton;
use Illuminate\Database\Seeder;

class CantonTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $canton = new canton;
        $canton->canton_name = 'Waadt';
        $canton->save();

        $canton = new canton;
        $canton->canton_name = 'Genf';
        $canton->save();

        $canton = new canton;
        $canton->canton_name = 'Freiburg';
        $canton->save();

        $canton = new canton;
        $canton->canton_name = 'Bern';
        $canton->save();

        $canton = new canton;
        $canton->canton_name = 'Wallis';
        $canton->save();

        $canton = new canton;
        $canton->canton_name = 'Neuenburg';
        $canton->save();

        $canton = new canton;
        $canton->canton_name = 'Jura';
        $canton->save();

        $canton = new canton;
        $canton->canton_name = 'Solothurn';
        $canton->save();

        $canton = new canton;
        $canton->canton_name = 'Basel-Landschaft';
        $canton->save();

        $canton = new canton;
        $canton->canton_name = 'Basel-Stadt';
        $canton->save();

        $canton = new canton;
        $canton->canton_name = 'Aargau';
        $canton->save();

        $canton = new canton;
        $canton->canton_name = 'Luzern';
        $canton->save();

        $canton = new canton;
        $canton->canton_name = 'Obwalden';
        $canton->save();

        $canton = new canton;
        $canton->canton_name = 'Nidwalden';
        $canton->save();

        $canton = new canton;
        $canton->canton_name = 'Zug';
        $canton->save();

        $canton = new canton;
        $canton->canton_name = 'Uri';
        $canton->save();

        $canton = new canton;
        $canton->canton_name = 'Schwytz';
        $canton->save();

        $canton = new canton;
        $canton->canton_name = 'Tessin';
        $canton->save();

        $canton = new canton;
        $canton->canton_name = 'Graubünden';
        $canton->save();

        $canton = new canton;
        $canton->canton_name = 'IT';
        $canton->save();

        $canton = new canton;
        $canton->canton_name = 'St. Gallen';
        $canton->save();

        $canton = new canton;
        $canton->canton_name = 'Zürich';
        $canton->save();

        $canton = new canton;
        $canton->canton_name = 'Schaffhausen';
        $canton->save();

        $canton = new canton;
        $canton->canton_name = 'Büsingen';
        $canton->save();

        $canton = new canton;
        $canton->canton_name = 'Thurgau';
        $canton->save();

        $canton = new canton;
        $canton->canton_name = 'Glarus';
        $canton->save();

        $canton = new canton;
        $canton->canton_name = 'Appenzell Ausserrhoden';
        $canton->save();

        $canton = new canton;
        $canton->canton_name = 'Appenzell Innerrhoden';
        $canton->save();

        $canton = new canton;
        $canton->canton_name = 'Fürstentum Liechtenstein';
        $canton->save();
    }
}
