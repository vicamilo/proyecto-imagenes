<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\File;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $files = File::where('user_id', auth()->user()->id)->paginate(10);
        return view('admin.files.index', compact('files'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.files.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|image|max:100000'
        ]);


        $nombre = Str::random(10) . $request->file('file')->getClientOriginalName();

        $ruta = storage_path() . '\app\public\imagenes/' . $nombre;
        
        $ancho_original =  Image::make($request->file('file'))->width();
        $largo_original =  Image::make($request->file('file'))->height();
        //$orientacion = Image::make($request->file('file'))->orientate();
        //->resize(ancho,largo);
        //->resize(1123,796)

        if($ancho_original > 1123 && $largo_original > 796){

            Image::make($request->file('file'))
            ->resize(1123,796)
            ->save($ruta);

            File::create([
                'user_id' => auth()->user()->id,
                'url' => '/storage/imagenes/' . $nombre,
                'ancho' => $ancho_original,
                'largo' => $largo_original
        
            ]);    
        }
        elseif($ancho_original > 1123 && $largo_original < 796){

            Image::make($request->file('file'))
            ->resize(1123,null, function($constraint){
                $constraint->aspectRatio();
            })
            ->save($ruta);

            File::create([
                'user_id' => auth()->user()->id,
                'url' => '/storage/imagenes/' . $nombre,
                'ancho' => $ancho_original,
                'largo' => $largo_original
        
            ]);  
        }
        elseif($ancho_original < 1123 && $largo_original > 796){

            Image::make($request->file('file'))
            ->resize(null,796, function($constraint){
                $constraint->aspectRatio();
            })
            ->save($ruta);

            File::create([
                'user_id' => auth()->user()->id,
                'url' => '/storage/imagenes/' . $nombre,
                'ancho' => $ancho_original,
                'largo' => $largo_original
        
            ]);  
        }        
        else{
                Image::make($request->file('file'))
                ->resize($ancho_original,$largo_original)
                ->save($ruta);

                File::create([
                    'user_id' => auth()->user()->id,
                    'url' => '/storage/imagenes/' . $nombre,
                    'ancho' => $ancho_original,
                    'largo' => $largo_original
            
                ]); 
        }
   
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($file)
    {
        return view('admin.files.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($file)
    {
        return view('admin.files.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $file)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($file)
    {
        //
    }
}
