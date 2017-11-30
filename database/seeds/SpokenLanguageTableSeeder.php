<?php

use App\Models\SpokenLanguage;
use Illuminate\Database\Seeder;

class SpokenLanguageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $spokenLanguage = new SpokenLanguage;
        $spokenLanguage->spoken_language_name = 'English';
        $spokenLanguage->save();

        $spokenLanguage = new SpokenLanguage;
        $spokenLanguage->spoken_language_name = 'German';
        $spokenLanguage->save();

        $spokenLanguage = new SpokenLanguage;
        $spokenLanguage->spoken_language_name = 'Italian';
        $spokenLanguage->save();

        $spokenLanguage = new SpokenLanguage;
        $spokenLanguage->spoken_language_name = 'French';
        $spokenLanguage->save();

        $spokenLanguage = new SpokenLanguage;
        $spokenLanguage->spoken_language_name = 'Spanish';
        $spokenLanguage->save();

        $spokenLanguage = new SpokenLanguage;
        $spokenLanguage->spoken_language_name = 'Russian';
        $spokenLanguage->save();

        $spokenLanguage = new SpokenLanguage;
        $spokenLanguage->spoken_language_name = 'Portuguese';
        $spokenLanguage->save();

        $spokenLanguage = new SpokenLanguage;
        $spokenLanguage->spoken_language_name = 'Dutch';
        $spokenLanguage->save();

        $spokenLanguage = new SpokenLanguage;
        $spokenLanguage->spoken_language_name = 'Serbian';
        $spokenLanguage->save();

        $spokenLanguage = new SpokenLanguage;
        $spokenLanguage->spoken_language_name = 'Slovenian';
        $spokenLanguage->save();

        $spokenLanguage = new SpokenLanguage;
        $spokenLanguage->spoken_language_name = 'Slovak';
        $spokenLanguage->save();

        $spokenLanguage = new SpokenLanguage;
        $spokenLanguage->spoken_language_name = 'Greek';
        $spokenLanguage->save();

        $spokenLanguage = new SpokenLanguage;
        $spokenLanguage->spoken_language_name = 'Bulgarian';
        $spokenLanguage->save();

        $spokenLanguage = new SpokenLanguage;
        $spokenLanguage->spoken_language_name = 'Czech';
        $spokenLanguage->save();

        $spokenLanguage = new SpokenLanguage;
        $spokenLanguage->spoken_language_name = 'Indian';
        $spokenLanguage->save();

        $spokenLanguage = new SpokenLanguage;
        $spokenLanguage->spoken_language_name = 'Arabic';
        $spokenLanguage->save();

        $spokenLanguage = new SpokenLanguage;
        $spokenLanguage->spoken_language_name = 'Japanese';
        $spokenLanguage->save();

        $spokenLanguage = new SpokenLanguage;
        $spokenLanguage->spoken_language_name = 'Chinese';
        $spokenLanguage->save();

        $spokenLanguage = new SpokenLanguage;
        $spokenLanguage->spoken_language_name = 'Finnish';
        $spokenLanguage->save();

        $spokenLanguage = new SpokenLanguage;
        $spokenLanguage->spoken_language_name = 'Norwegian';
        $spokenLanguage->save();

        $spokenLanguage = new SpokenLanguage;
        $spokenLanguage->spoken_language_name = 'Swedish';
        $spokenLanguage->save();

        $spokenLanguage = new SpokenLanguage;
        $spokenLanguage->spoken_language_name = 'Danish';
        $spokenLanguage->save();

        $spokenLanguage = new SpokenLanguage;
        $spokenLanguage->spoken_language_name = 'Turkish';
        $spokenLanguage->save();

        $spokenLanguage = new SpokenLanguage;
        $spokenLanguage->spoken_language_name = 'Polish';
        $spokenLanguage->save();

        $spokenLanguage = new SpokenLanguage;
        $spokenLanguage->spoken_language_name = 'Romanian';
        $spokenLanguage->save();
    }
}
