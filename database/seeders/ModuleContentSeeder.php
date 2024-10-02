<?php

namespace Database\Seeders;

use App\Models\ModuleContent;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ModuleContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Al fer un db:seed eliminara tot el contingut pujat a app/uploads
        $filesFoldier = storage_path('app/uploads');
        File::cleanDirectory($filesFoldier);

        ModuleContent::factory([
            "id_module" => 1,
            "title" => "Que és GNU/Linux",
            "content" => "¿Que es Linux?
Linux es el nombre que reciben una serie de sistemas operativos bajo la licencia GNU GPL (General Public License o Licencia Pública General de GNU)que son su mayoría gratuitos y con todo lo necesario para hacer funcionar un PC, con la peculiaridad de que podemos instalar un sistema muy ligero e ir añadiendo todo lo necesario posteriormente o según lo vayamos necesitando.

Linux es multiusuario, multitarea y multiplataforma, además puede funcionar en modo consola para un consumo mínimo de recursos, pero que también podemos hacer funcionar con entorno gráfico, instalando uno mediante comandos de terminal o adquiriendo un paquete en el que venga uno incluido. Si quieres probarlo puedes usar una máquina virtual (el programa mas conocido es virtualbox) antes de instalarlo en tu PC.

Al ser código libre podemos utilizarlo, copiarlo, modificarlo y redistribuirlo libremente para cualquier uso que queramos darle, pero siempre bajo los términos de la licencia GPL de GNU. Un ejemplo es el caso de Android, que usa el núcleo Linux pero que en este caso no tiene componentes GNU sino que está personalizado para los teléfonos móviles o tablets que lo usan.

Realmente Linux es el nombre que recibe el núcleo o kernel de este sistema operativo, para los entendidos en la materia las diferentes versiones de este sistema operativo son denominados comúnmente distros, de distribuciones, que básicamente son este núcleo del sistema al que se le han añadido aplicaciones y programas para construir un sistema operativo completo con muchas funciones. Hay distribuciones de todo tipo
¿Para que sirve Linux?

Linux sirve para hacer funcionar todo el hardware de un PC, ya que un ordenador no puede funcionar sin un sistema operativo y Linux es un sistema operativo gratuito. Linux está en muchos de los ordenadores que se venden sin sistema operativo, pero esto no es legal en España ya que un PC sin sistema operativo no es un PC funcional, muchos fabricantes optan por añadir una versión o distro de Linux.

Este sistema operativo también es conocido por controlar superordenadores o servidores que es donde en realidad Linux toma importancia. La mayoría de los supercomputadores más importantes del mundo usan algún sistema GNU/Linux, por lo que también sirve para controlar superordenadores con tareas específicas, gracias a su capacidad de personalización.

Este sistema operativo Linux también es muy usado como un sistema operativo Live, esto es para arrancar un PC sin necesidad de instalar ningún sistema operativo ni utilizar el del disco duro integrado. Este sistema, que suele ser bastante ligero, se carga en memoria y es de gran utilidad para la recuperación de datos y gestión de particiones en discos duros cuando ocurre una catástrofe, en este caso con alguna utilidad integrada, en alguna distro de Linux que se pueda ejecutar de manera Live, podemos intentar arreglar el desastre ocasionado o gestionar las particiones con los discos duros de una manera similar a como se hace con Diskpart, pero sin necesidad de instalar nada.

Otra de las utilidades de un sistema Linux Live es la auditoría de redes Wi-Fi, aunque fue más usado para descifrar contraseñas de redes Wi-Fi no muy seguras y conseguir internet gratis. Fue muy extendido cuando estalló el boom de las redes Wi-Fi domésticas, en muy pocos minutos, con los conocimientos necesarios (aunque luego salieron mil tutoriales en internet) y una distribución Linux live que ejecutaba la aplicación WiFiSlax, podías conseguir la contraseña de algunas redes a las que podías acceder a su conexión a internet o incluso a sus datos si tenía estos compartidos.

Linux está presente en multitud de aparatos que usamos en el día a día, como móviles Android, NAS, algunos routers, televisiones, TV Box, calculadoras o hasta el mismísimo colisionador de hadrones funciona con una distribución específica llamada Scientific Linux que finalmente ha sido sustituida por CentOS. Microsoft también ha empezado a incluir el núcleo de este sistema en Windows 10.",
        ])->create();

        ModuleContent::factory([
            "id_module" => 1,
            "title" => "Instal·lació",
            "content" => "Ubuntu es un sistema operativo diseñado para arrancar en Modo Live, es decir, para cargarse en la memoria RAM desde la ISO y permitirnos probarlo sin instalar ni alterar nada del sistema. Lo primero que veremos cuando el sistema operativo acabe de cargar será una pantalla como la siguiente.

En ella tendremos que elegir nuestro idioma, y además también si queremos probar Ubuntu, o si queremos lanzar directamente el asistente de instalación. El resultado en ambos casos será el mismo, pero nosotros vamos a usar la opción de «probar» para poder cargar Ubuntu en el PC y poder usarlo mientras lo instalamos.

Los pasos para la instalación de esta distro Linux son muy sencillos. En resumen, los pasos que debemos realizar son:

Ejecutar el instalador.
Seleccionar el idioma que queremos usar.
Elegir la distribución de teclado.
Seleccionar el modo de instalación (normal o mínima).
Elegir si queremos bajar actualizaciones durante el proceso, o paquetes privativos de terceros.
Elegir cómo instalar Ubuntu en el disco (usarlo todo, o crear particiones y puntos de montaje a mano). También si queremos usar, o no, cifrado de discos.
Configurar la ubicación.
Crear el usuario (nombre, nombre del equipo, contraseña).
Vamos a ver, paso a paso, todo este proceso de instalación. Lo primero, cuando veamos el escritorio, aquí tendremos un icono llamado «Instalar Ubuntu».

Hacemos doble clic sobre él para lanzar el asistente de instalación. Lo primero que nos encontraremos será con la posibilidad de elegir el idioma del instalador, así como de leer las notas de publicación.

Continuamos, y en el siguiente paso el asistente nos permitirá configurar el idioma y distribución del teclado. Podemos elegirlo nosotros mismos de la lista, o dejar que el programa lo detecte automáticamente a través de una serie de pulsaciones.


Seguimos con la instalación. El siguiente punto nos va a permitir elegir el tipo de instalación que queremos hacer. Ubuntu nos ofrece dos tipos de instalación:

Normal: instala una serie de programas esenciales para poder usar la distro para todo, desde navegar hasta ofimática, juegos y multimedia.
Mínima: una instalación mucho más pequeña. Incluye navegador web y los paquetes mínimos necesarios para funcionar.
La opción recomendada para la mayoría de los usuarios es la instalación normal. Además, aquí también podemos elegir si queremos bajar actualizaciones a la vez que instalamos el sistema operativo, o si queremos incluir el software privativo para instalar automáticamente los drivers de la GPU o de las tarjetas Wi-Fi, además de una serie de codecs privativos


Crear particiones para Ubuntu
En el siguiente paso podremos elegir cómo instalar Ubuntu en el disco duro. Si tenemos otro sistema operativo ya instalado, el asistente nos dará la opción de instalarlo junto a él. De lo contrario, nos permitirá borrar todo el disco y configurarlo automáticamente para instalar la distro en él. Eso sí, esta segunda opción borrará todos los datos que tengamos guardados en dicho disco duro para poder darle formato y crear la tabla de particiones estándar

El asistente de instalación nos permite elegir si queremos usar un sistema de cifrado de datos, además de activar una opción experimental para usar un sistema de archivos ZFS

Si elegimos «Más opciones» en vez de utilizar todo el disco, podremos abrir el gestor de particiones de Ubuntu. Y desde aquí podremos crear las particiones que queramos usar. Esto es recomendable para usuarios que tengan cierto nivel de conocimientos. Si no los tenemos, lo mejor es optar por el modo automático.

Si elegimos el modo automático os recomendamos crear, al menos, las siguientes particiones:

/ – Raíz de la distro Linux.
/home – donde guardaremos todos nuestros datos personales. Tiene que ser la partición de más tamaño.
/boot – lugar donde instalaremos el gestor de arranque. Cuando esté todo listo, haremos clic sobre «Instalar ahora» para comenzar el proceso de instalación. Y podremos ver un resumen con las particiones y puntos de montaje que vamos a usar.

Si todo está correcto, continuamos y comenzará la copia de los datos del sistema operativo. Pero, aunque ya se estén copiando los archivos, aún no hemos acabado de configurar Ubuntu.

Últimos pasos para terminar la instalación
Mientras se copian los datos de nuestro Ubuntu y se aplican las configuraciones seleccionadas tendremos que terminar algunas configuraciones esenciales. La primera de ellas será elegir nuestra región, dónde vivimos. Esto se usará para ajustar el sistema métrico, el huso horario y la moneda utilizada.

También tendremos que crear nuestro usuario principal. Este estará formado por un nombre de usuario, una contraseña y el nombre que queremos dar al PC en red. También podemos elegir si queremos que se inicie sesión automáticamente o no.

Listo. Ya hemos configurado Ubuntu. Ahora solo nos queda esperar a que se complete el proceso de instalación del sistema operativo. Este puede tardar más o menos según el hardware del PC y si hemos elegido bajar, o no, las actualizaciones durante este proceso. Mientras dura la instalación podremos ver algunas de las características y usos de Ubuntu.

Cuando acabe el proceso de copia de los datos podremos ver un mensaje como el siguiente que nos indicará que nuestro Ubuntu se ha instalado correctamente y que tendremos que reiniciar el PC para terminar con la instalación y poder empezar a usar este nuevo sistema operativo.

Por último, queremos recordar que el instalador de Ubuntu 21.10 va a ser algo diferente al que llevamos conociendo hasta ahora. Cuando llegue la nueva versión de la distro a su fase estable actualizaremos el tutorial para explicar cuáles son las nuevas opciones de instalación que nos ofrecerá el nuevo Ubuntu 21.10.",
        ])->create();
    }
}
