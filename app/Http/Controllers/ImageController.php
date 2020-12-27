<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Image;

class ImageController extends Controller
{
    

    public function __construc(){
        $this->middleware('Auth');
    }

    public function create(){
        return view('image.create');
    }

    public function save(Request $request){

        //validacion 

        $validate = $this->validate($request,[
            'description' => 'required',
            'image_path' => 'required|image'
        ]);

        //recoger datos
       $image_path = $request->file('image_path');
       $description = $request->input('description');

       //asignar valores nuevo objeto

       $user= Auth::user();
       $image = new Image();
       $image->user_id = $user->id;
       
       $image->description =  $description;

       //subir fichero

       if($image_path){
           $image_path_name = time().$image_path->getClientOriginalName();
           Storage::disk('images')->put($image_path_name, File::get($image_path));
           $image->image_path = $image_path_name;
            
       }
       
       $image->save();

       return redirect()->route('home')->with([
           'message' => 'La foto ha sido subida correctamente!!'
       ]);

       

    }

    public function getImage($filename){
        $file = Storage::disk('images')->get($filename);

        return new Response($file,200);

    }

    public function detail($id){

        $image = Image::find($id);


        return view('image.detail',[
            'image' => $image

        ]);

    }
}
