<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Perfil;
use App\Admin;
use App\Autor;
use App\Editorial;
use App\Genero;
use App\Libro;
use App\Novedad;
use App\Trailer;
use App\Capitulo;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
use App\Traits\FileUpload;

class BookflixTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    use FileUpload;
    public function run()
    {
    // Borrar archivos (Ya que vamos a re-crear la bd con semillas nuevas)
        // $files =   Storage::allFiles($dir);
        // $files =   Storage::files($dir);
        Storage::delete(Storage::files('public/novedades'));
        Storage::delete(Storage::files('public/capitulos'));
        Storage::delete(Storage::files('public/trailers'));
        Storage::delete(Storage::files('public/portadas'));

        //$file = $this->TrailerFileUpload(Form::file(public_path('image/seeds/portadas/hp6.jpg')));
        //$filePath = $file->url;
        //echo $filePath;
        //echo Storage::putFile('public/novedades', new File(public_path('image/seeds/portadas/hp6.jpg')), 'public');
        //
        // Luego de muchas pruebas esta es la mejor forma:
        //$this->guardarArchivo('portadas/hp6.jpg');



    // Usuarios
    //User::truncate(); // Evita duplicar datos
    //Perfil::truncate();

        // Estandar
        DB::table('users')->insert([
            'name' => 'Usuario Estandar',
            'dni' => '11222333',
            'email' => 'estandar@bookflix.com',
            'cuenta_activa' => true,
            'es_premium' => false,
            'password' => bcrypt('123456'),
        ]);
            // Perfiles para este user
                DB::table('perfiles')->insert([
                    'nombre' => 'Estandar1',
                    'user_id' => 1, // Relación con usuario
                ]);

        // Premium
        DB::table('users')->insert([
            'name' => 'Usuario Premium',
            'dni' => '22333444',
            'email' => 'premium@bookflix.com',
            'cuenta_activa' => true,
            'es_premium' => true,
            'password' => bcrypt('123456'),
        ]);
            // Perfiles para este user
                DB::table('perfiles')->insert([
                    'nombre' => 'Premium1',
                    'user_id' => 2, // Relación con usuario
                ]);
                DB::table('perfiles')->insert([
                    'nombre' => 'Premium2',
                    'user_id' => 2, // Relación con usuario
                ]);
                DB::table('perfiles')->insert([
                    'nombre' => 'Premium3',
                    'user_id' => 2, // Relación con usuario
                ]);
        // Sin Perfiles
        DB::table('users')->insert([
            'name' => 'Usuario SinPerfil',
            'dni' => '33444555',
            'email' => 'sinperfil@bookflix.com',
            'cuenta_activa' => true,
            'es_premium' => true,
            'password' => bcrypt('123456'),
        ]);
        // Inactivo
        DB::table('users')->insert([
            'name' => 'Usuario Inactivo',
            'dni' => '44555666',
            'email' => 'inactivo@bookflix.com',
            'cuenta_activa' => false,
            'es_premium' => true,
            'password' => bcrypt('123456'),
        ]);


    // Administrador
    Admin::truncate();

        // Admin 1
        DB::table('admins')->insert([
            'name' => 'admin1',
            'email' => 'admin1@bookflix.com',
            'password' => bcrypt('123456'),
        ]);


    // Generos
    //Genero::truncate();

        // Genero #1
        $genero = new Genero();
        $genero->nombre = "Ciencia Ficción";
        $genero->save();
        // Genero #2
        $genero = new Genero();
        $genero->nombre = "Autobiografía";
        $genero->save();
        // Genero #3
        $genero = new Genero();
        $genero->nombre = "Terror";
        $genero->save();
        // Genero #4
        $genero = new Genero();
        $genero->nombre = "Fantasía";
        $genero->save();
        // Genero #5
        $genero = new Genero();
        $genero->nombre = "Aventura";
        $genero->save();
        // Genero #6
        $genero = new Genero();
        $genero->nombre = "Drama";
        $genero->save();
        // Genero #6
        $genero = new Genero();
        $genero->nombre = "Investigación";
        $genero->save();


    // Autores
    //Autor::truncate();

        // Autor #1
        $autor = new Autor();
        $autor->nombre = "J.R.R. Tolkien";
        $autor->save();
        // Autor #2
        $autor = new Autor();
        $autor->nombre = "Ana Frank";
        $autor->save();
        // Autor #3
        $autor = new Autor();
        $autor->nombre = "Stephen King";
        $autor->save();
        // Autor #4
        $autor = new Autor();
        $autor->nombre = "J.K Rowling";
        $autor->save();
        // Autor #5
        $autor = new Autor();
        $autor->nombre = "Curtis Hewet";
        $autor->save();
        // Autor #6
        $autor = new Autor();
        $autor->nombre = "Isaac Asimov";
        $autor->save();
        // Autor #6
        $autor = new Autor();
        $autor->nombre = "Euclides";
        $autor->save();


    // Editoriales
    //Editorial::truncate();

        // Editorial #1
        $editorial = new Editorial();
        $editorial->nombre = "Gnome Press";
        $editorial->save();
        // Editorial #2
        $editorial = new Editorial();
        $editorial->nombre = "Garbo";
        $editorial->save();
        // Editorial #3
        $editorial = new Editorial();
        $editorial->nombre = "Viking Press";
        $editorial->save();
        // Editorial #4
        $editorial = new Editorial();
        $editorial->nombre = "Bloomsbury Publishing";
        $editorial->save();


    // Libros
    //Libro::truncate();

        // Libro #1
        $libro = new Libro();
        $libro->titulo = "Harry Potter y el Príncipe Mestizo";
        $libro->portada = $this->guardarArchivo('portadas/hp6.jpg');
        $libro->isbn = "1234567891";
        $libro->autor_id = 4;
        $libro->editorial_id = 1;
        $libro->fecha_de_lanzamiento = Carbon::now();
        $libro->fecha_de_vencimiento = Carbon::now()->addYear();
        $libro->save();
        $libro->generos()->attach([4, 5]); //Relacionar el libro a dos etiquetas
            // Trailer para este libro
            $trailer = new Trailer();
            $trailer->titulo = "Trailer Harry Potter 6";
            $trailer->pdf = $this->guardarArchivo('trailers/sample.pdf');
            $trailer->libro_id = 1;
            $trailer->save();
            // Capitulos
                //Capítulo 1
                $capitulo = new Capitulo();
                $capitulo->titulo = "Capitulo 1";
                $capitulo->pdf = $this->guardarArchivo('trailers/sample.pdf');
                $capitulo->fecha_de_lanzamiento = Carbon::now();
                $capitulo->fecha_de_vencimiento = Carbon::now()->addYear()->subDay(); 
                $capitulo->libro_id = 1;
                $capitulo->save();
                //Capítulo 2
                $capitulo = new Capitulo();
                $capitulo->titulo = "Capitulo 2";
                $capitulo->pdf = $this->guardarArchivo('trailers/sample.pdf');
                $capitulo->fecha_de_lanzamiento = Carbon::now();
                $capitulo->fecha_de_vencimiento = Carbon::now()->addYear()->subDay(); 
                $capitulo->libro_id = 1;
                $capitulo->save();


        // Libro #2
        $libro = new Libro();
        $libro->titulo = "Diario de una Jovencita";
        $libro->portada = $this->guardarArchivo('portadas/anne.jpg');
        $libro->isbn = "1234567892";
        $libro->autor_id = 2;
        $libro->editorial_id = 2;
        $libro->fecha_de_lanzamiento = Carbon::now();
        $libro->fecha_de_vencimiento = Carbon::now()->addYear();
        $libro->save();
        $libro->generos()->attach([6]);
            // Trailer para este libro
            $trailer = new Trailer();
            $trailer->titulo = "Trailer Libro de Anne Frank";
            $trailer->pdf = $this->guardarArchivo('trailers/sample.pdf');
            $trailer->libro_id = 2;
            $trailer->save();
            // Capitulos
                //Capítulo 1
                $capitulo = new Capitulo();
                $capitulo->titulo = "Capitulo I";
                $capitulo->pdf = $this->guardarArchivo('trailers/sample.pdf');
                $capitulo->fecha_de_lanzamiento = Carbon::now();
                $capitulo->fecha_de_vencimiento = Carbon::now()->addYear()->subDay(); 
                $capitulo->libro_id = 2;
                $capitulo->save();

        // Libro #3
        $libro = new Libro();
        $libro->titulo = "El Hobbit";
        $libro->portada = $this->guardarArchivo('portadas/hobbit.jpg');
        $libro->isbn = "1234567893";
        $libro->autor_id = 1;
        $libro->editorial_id = 2;
        $libro->fecha_de_lanzamiento = Carbon::now();
        $libro->fecha_de_vencimiento = Carbon::now()->addYear();
        $libro->save();
        $libro->generos()->attach([4, 5]);
            // Trailer para este libro
            $trailer = new Trailer();
            $trailer->titulo = "Trailer Hobbit";
            $trailer->pdf = $this->guardarArchivo('trailers/sample.pdf');
            $trailer->libro_id = 3;
            $trailer->save();
            // Capitulos
                //Capítulo 1
                $capitulo = new Capitulo();
                $capitulo->titulo = "1";
                $capitulo->pdf = $this->guardarArchivo('trailers/sample.pdf');
                $capitulo->fecha_de_lanzamiento = Carbon::now();
                $capitulo->fecha_de_vencimiento = Carbon::now()->addYear()->subDay(); 
                $capitulo->libro_id = 3;
                $capitulo->save();
                //Capítulo 2
                $capitulo = new Capitulo();
                $capitulo->titulo = "2";
                $capitulo->pdf = $this->guardarArchivo('trailers/sample.pdf');
                $capitulo->fecha_de_lanzamiento = Carbon::now();
                $capitulo->fecha_de_vencimiento = Carbon::now()->addYear()->subDay(); 
                $capitulo->libro_id = 3;
                $capitulo->save();

        // Libro #4
        $libro = new Libro();
        $libro->titulo = "The Connections In Our Brain";
        $libro->portada = $this->guardarArchivo('portadas/connection.jpg');
        $libro->isbn = "1234567894";
        $libro->autor_id = 5;
        $libro->editorial_id = 4;
        $libro->fecha_de_lanzamiento = Carbon::now();
        $libro->fecha_de_vencimiento = Carbon::now()->addYear();
        $libro->save();
        $libro->generos()->attach([1,7]);
            // Trailer para este libro
            $trailer = new Trailer();
            $trailer->titulo = "Trailer Connections";
            $trailer->pdf = $this->guardarArchivo('trailers/sample.pdf');
            $trailer->libro_id = 4;
            $trailer->save();
            // Capitulos
                //Capítulo 1
                $capitulo = new Capitulo();
                $capitulo->titulo = "Unico";
                $capitulo->pdf = $this->guardarArchivo('trailers/sample.pdf');
                $capitulo->fecha_de_lanzamiento = Carbon::now();
                $capitulo->fecha_de_vencimiento = Carbon::now()->addYear()->subDay(); 
                $capitulo->libro_id = 4;
                $capitulo->save();

        // Libro #5
        $libro = new Libro();
        $libro->titulo = "Yo, robot";
        $libro->portada = $this->guardarArchivo('portadas/robot.jpg');
        $libro->isbn = "1234567895";
        $libro->autor_id = 6;
        $libro->editorial_id = 3;
        $libro->fecha_de_lanzamiento = Carbon::now();
        $libro->fecha_de_vencimiento = Carbon::now()->addYear();
        $libro->save();
        $libro->generos()->attach([1]);
            // Trailer para este libro
            $trailer = new Trailer();
            $trailer->titulo = "Robot";
            $trailer->pdf = $this->guardarArchivo('trailers/sample.pdf');
            $trailer->libro_id = 5;
            $trailer->save();
            // Capitulos
                //Capítulo 1
                $capitulo = new Capitulo();
                $capitulo->titulo = "i";
                $capitulo->pdf = $this->guardarArchivo('trailers/sample.pdf');
                $capitulo->fecha_de_lanzamiento = Carbon::now();
                $capitulo->fecha_de_vencimiento = Carbon::now()->addYear()->subDay(); 
                $capitulo->libro_id = 5;
                $capitulo->save();

        // Libro #6
        $libro = new Libro();
        $libro->titulo = "Elementos";
        $libro->portada = $this->guardarArchivo('portadas/euclides.jpg');
        $libro->isbn = "1234567896";
        $libro->autor_id = 4;
        $libro->editorial_id = 4;
        $libro->fecha_de_lanzamiento = Carbon::now();
        $libro->fecha_de_vencimiento = Carbon::now()->addYear();
        $libro->save();
        $libro->generos()->attach([7]);
            // Trailer para este libro
            $trailer = new Trailer();
            $trailer->titulo = "Elementos";
            $trailer->pdf = $this->guardarArchivo('trailers/sample.pdf');
            $trailer->libro_id = 6;
            $trailer->save();
            // Capitulos
                //Capítulo 1
                $capitulo = new Capitulo();
                $capitulo->titulo = "I";
                $capitulo->pdf = $this->guardarArchivo('trailers/sample.pdf');
                $capitulo->fecha_de_lanzamiento = Carbon::now();
                $capitulo->fecha_de_vencimiento = Carbon::now()->addYear()->subDay(); 
                $capitulo->libro_id = 6;
                $capitulo->save();
                //Capítulo 1
                $capitulo = new Capitulo();
                $capitulo->titulo = "II";
                $capitulo->pdf = $this->guardarArchivo('trailers/sample.pdf');
                $capitulo->fecha_de_lanzamiento = Carbon::now();
                $capitulo->fecha_de_vencimiento = Carbon::now()->addYear()->subDay(); 
                $capitulo->libro_id = 6;
                $capitulo->save();
                //Capítulo 1
                $capitulo = new Capitulo();
                $capitulo->titulo = "III";
                $capitulo->pdf = $this->guardarArchivo('trailers/sample.pdf');
                $capitulo->fecha_de_lanzamiento = Carbon::now();
                $capitulo->fecha_de_vencimiento = Carbon::now()->addYear()->subDay(); 
                $capitulo->libro_id = 6;
                $capitulo->save();
                //Capítulo 1
                $capitulo = new Capitulo();
                $capitulo->titulo = "IV";
                $capitulo->pdf = $this->guardarArchivo('trailers/sample.pdf');
                $capitulo->fecha_de_lanzamiento = Carbon::now();
                $capitulo->fecha_de_vencimiento = Carbon::now()->addYear()->subDay(); 
                $capitulo->libro_id = 6;
                $capitulo->save();
                //Capítulo 1
                $capitulo = new Capitulo();
                $capitulo->titulo = "V";
                $capitulo->pdf = $this->guardarArchivo('trailers/sample.pdf');
                $capitulo->fecha_de_lanzamiento = Carbon::now();
                $capitulo->fecha_de_vencimiento = Carbon::now()->addYear()->subDay(); 
                $capitulo->libro_id = 6;
                $capitulo->save();
                //Capítulo 1
                $capitulo = new Capitulo();
                $capitulo->titulo = "VI";
                $capitulo->pdf = $this->guardarArchivo('trailers/sample.pdf');
                $capitulo->fecha_de_lanzamiento = Carbon::now();
                $capitulo->fecha_de_vencimiento = Carbon::now()->addYear()->subDay(); 
                $capitulo->libro_id = 6;
                $capitulo->save();
        
        // Novedades
        $novedad = new Novedad();
        $novedad->titulo = "Novedad sin archivo";
        $novedad->descripcion = "Una novedad sin archivo";
        $novedad->archivo = 'noFile';
        $novedad->fecha_de_publicacion = Carbon::now();
        $novedad->save();

        $novedad = new Novedad();
        $novedad->titulo = "Novedad con imagen";
        $novedad->archivo = $this->guardarArchivo('novedades/edward.jpg');
        $novedad->es_video = false;
        $novedad->descripcion = "Una novedad con archivo de imagen";
        $novedad->fecha_de_publicacion = Carbon::now();
        $novedad->save();

        $novedad = new Novedad();
        $novedad->titulo = "Novedad con video";
        $novedad->archivo = $this->guardarArchivo('novedades/video_earth.mp4');
        $novedad->es_video = true;
        $novedad->descripcion = "Una novedad con archivo de video";
        $novedad->fecha_de_publicacion = Carbon::now();
        $novedad->save();

        $novedad = new Novedad();
        $novedad->titulo = "Novedad Futura";
        $novedad->archivo = $this->guardarArchivo('novedades/question.jpg');
        $novedad->es_video = false;
        $novedad->descripcion = "Una novedad con fecha de publicacion futura";
        $novedad->fecha_de_publicacion = (Carbon::now()->addYear());
        $novedad->save();
        

        //factory(User::class, 5)->create();

        /*
        //Categoria::truncate(); // Evita duplicar datos, los comento por lo de las relaciones

        // $categoria = new Categoria();
        // $categoria->nombre = "Categoría 1";
        // $categoria->save();

        // $categoria = new Categoria();
        // $categoria->nombre = "Categoría 2";
        // $categoria->save();

        // $categoria = new Categoria();
        // $categoria->nombre = "Categoría 3";
        // $categoria->save();

        //comento estas seed porque voy a usar la fabrica
        factory(Categoria::class, 10)->create();

        //Etiqueta::truncate(); // Evita duplicar datos

        $etiqueta = new Etiqueta();
        $etiqueta->nombre = "Etiqueta 1";
        $etiqueta->save();

        $etiqueta = new Etiqueta();
        $etiqueta->nombre = "Etiqueta 2";
        $etiqueta->save();

        //Libro::truncate(); // Evita duplicar datos

        $libro = new Libro();
        $libro->titulo = "Mi primer libro";
        $libro->descripcion = "Extracto de mi primer libro";
        $libro->contenido = "<p>Resumen de mi primer libro</p>";
        $libro->fecha = Carbon::now();
        $libro->categoria_id = 1;
        $libro->save();
        
        $libro->etiquetas()->attach([1, 2]); //Relacionar el libro a dos etiquetas
        
        $libro = new Libro();
        $libro->titulo = "Mi segundo libro";
        $libro->descripcion = "Extracto de mi segundo libro";
        $libro->contenido = "<p>Resumen de mi segundo libro</p>";
        $libro->fecha = Carbon::now();
        $libro->categoria_id = 1;
        $libro->save();

        $libro->etiquetas()->attach([1]); //Relacionar el libro a una etiqueta

        $libro = new Libro();
        $libro->titulo = "Mi tercer libro";
        $libro->descripcion = "Extracto de mi tercer libro";
        $libro->contenido = "<p>Resumen de mi tercer libro</p>";
        $libro->fecha = Carbon::now();
        $libro->categoria_id = 1;
        $libro->save();

        $libro->etiquetas()->attach([2]); //Relacionar el libro a una etiqueta

        */
    }
    public function guardarArchivo($file){
        //$file = "novedades/edward.jpg";
        $folder = explode("/", $file)[0];
        $badname = Storage::putFile('public/'.$folder , new File(public_path('/image/seeds/'.$file)), 'public');
        // esto me da algo asi "public/portadas/mxiED6oizk413MyOBAoKuY49mUFxyiDg6CHDKyh1.jpeg"
        $filename = str_replace ( "public" , "storage" , $badname);
        // debe quedar asi "storage/portadas/mxiED6oizk413MyOBAoKuY49mUFxyiDg6CHDKyh1.jpeg";
        echo "archivo ".$file." guardado en ".$filename."\n";
        return $filename;
    }
}
