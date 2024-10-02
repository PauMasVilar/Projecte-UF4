<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ModuleContentFile extends Model
{
    use HasFactory;

    protected $table = 'module_content_files';

    protected $fillable = [
        "id",
        "module_content_id",
        "name",
        "path",
    ];

    // El que fà aquest mètode es al pasar l'id o l'objecte ModuleContentFile (que per defecte agafa l'id) tot i que et retorni l'id
    // al mostrar-lo a les rutes mostrarà el camp "name". Així al pasar per sobre el ratolí al a href en comtpes de sortir per exemple
    // "4" mostrará "Exercici 2 - SOX". Així també al obrir el pdf en una pàgina, el nom de la pàgina serà el nom, el nom del pdf serà també 
    // el nom i al descarregar el pdf, també agafara el nom.
    public function getRouteKeyName()
    {
        return 'name';
    }
}
