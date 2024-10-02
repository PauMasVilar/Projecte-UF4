<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Course::factory([
            "id_professor" => 1,
            "name" => "Linux des de zero",
            "description" => "Un curs de Linux per aprendre tot el necessari per administrar sistemes Linux, perfecte per a programadors i administradors de sistemes.",
            'duration' => rand(5, 250),
            'start_date' => Carbon::now()->addDays(10),
            'end_date' => Carbon::now()->addDays(10)->addDays(rand(10, 90))
        ])->create();

        Course::factory([
            "id_professor" => 1,
            "name" => "SQL desde Cero",
            "description" => "Vols embarcar-te a l'aventura de les dades? Aquest curs és perfecte per a curiosos digitals i aspirants a mestres de dades, ja que comença amb allò bàsic i no necessita més que el teu entusiasme i una mica de coneixement informàtic general. Prepara't per convertir el teu ordinador en una potent eina de consultes.",
            'duration' => rand(5, 250),
            'start_date' => Carbon::now()->addDays(10),
            'end_date' => Carbon::now()->addDays(10)->addDays(rand(10, 90))
        ])->create();

        Course::factory([
            "id_professor" => 2,
            "name" => "Introducció a la programació amb Pseudocodi",
            "description" => "En aquest curs aprendrem els fonaments a la programació estructurada. Estudiarem el cicle de desenvolupament d'una aplicació: anàlisi, disseny i codificació mitjançant pseudocodi.",
            'duration' => rand(5, 250),
            'start_date' => Carbon::now()->addDays(10),
            'end_date' => Carbon::now()->addDays(10)->addDays(rand(10, 90))
        ])->create();

        Course::factory([
            "id_professor" => 2,
            "name" => "Introducció a Docker",
            "description" => "Aprèn els fonaments de Docker i la virtualització de contenidors amb aquest curs d'introducció a Docker online.",
            'duration' => rand(5, 250),
            'start_date' => Carbon::now()->addDays(10),
            'end_date' => Carbon::now()->addDays(10)->addDays(rand(10, 90))
        ])->create();

        Course::factory([
            "id_professor" => 3,
            "name" => "Git",
            "description" => "Aprèn a dominar GIT, usant la línia d'ordres, cosa que permet desenvolupar-nos amb GIT en qualsevol entorn per convertir-te en un professional.",
            'duration' => rand(5, 250),
            'start_date' => Carbon::now()->addDays(10),
            'end_date' => Carbon::now()->addDays(10)->addDays(rand(10, 90))
        ])->create();

        Course::factory([
            "id_professor" => 3,
            "name" => "HTML5 i CSS3",
            "description" => "Aprèn des de zero a crear pàgines web amb aquest curs d'HTML5 i CSS3. Crea pas a pas pàgines web professionals, aquest curs és ideal per introduir-te en el desenvolupament web.",
            'duration' => rand(5, 250),
            'start_date' => Carbon::now()->addDays(10),
            'end_date' => Carbon::now()->addDays(10)->addDays(rand(10, 90))
        ])->create();

        // Course::factory()->count(5)->create();
    }
}
