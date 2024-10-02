<?php

namespace Database\Seeders;

use App\Models\Module;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Module::factory([
            "id_course" => 1,
            "name" => "Introducció i preparació del curs",
            "description" => "Què és GNU/Linux?             
                            \nInstal·lació de SO Linux         
                            \nConnectar-se a Linux: Mètodes d'accés al sistema operatiu",
        ])->create();

        Module::factory([
            "id_course" => 1,
            "name" => "Comprendre i gestionar l'estructura de directoris de Linux",
            "description" => "Estructura de directoris Linux
                            \nLashell
                            \nUs inicial de bash i variables dentorn
                            \nPreguntes i respostes (I)
                            \nOrdres basiques
                            \nPreguntes i respostes (Ill)
                            \nPermisos i propietaris
                            \nModificar permisos i propietaris",
        ])->create();

        Module::factory([
            "id_course" => 1,
            "name" => "Gestió de fitxers",
            "description" => "Trobar fitxers i directoris
                            \nVisualització de fitxers
                            \nPreguntes i respostes (V)
                            \nEdició de fitxers
                            \nGestio de fitxers
                            \nEntrada, sortides, redireccions i canonades (1)
                            \nEntrada, sortides, redireccions i canonades (If)
                            \nVisualitzacio de fitxers Il: Us depressions regulars",
        ])->create();

        Module::factory([
            "id_course" => 1,
            "name" => "Processos i usuaris",
            "description" => "Processos i treballs
                            \nPreguntes i respostes (VI)
                            \nRepes de processos, treballs i ordre Kill
                            \nGestio d'usuaris
                            \nInstal·lació de Software
                            \nProgramacié de tasques amb cron
                            \nPreguntes i respostes (Vill)",
        ])->create();
    }
}
