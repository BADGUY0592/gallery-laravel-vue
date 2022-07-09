<?php

namespace App\Http\Controllers;

use App\Helper\GalleryHelper;
use App\Http\Resources\GalleryResource;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GalleryController extends Controller
{
    public function index() 
    {
        return view('welcome');
    }

    public function store(Request $request)
    {
        $rules=array(
            'name' => 'required',
            'image' =>  'required|image',
        );
        $error=Validator::make($request->all(),$rules);
        if($error->fails()){
            return response()->json(['errors'=>$error->errors()->all()]);
        }
        $file = $request->image->store('Gallery');
        $galleryHelper = new GalleryHelper();
        $imageLocation = $galleryHelper->get_image_location('storage/'.$file);
        $galleryData = [];
        if(count($imageLocation) == 0) {
            $galleryData['image_lat'] = $request->latitude;
            $galleryData['image_long'] = $request->longitude;
        } else {            
            $galleryData['image_lat'] = $imageLocation['latitude'];
            $galleryData['image_long'] = $imageLocation['longitude'];
        }
        $galleryData['image_name'] = $request->file('image')->getClientOriginalName();
        $galleryData['image_extension'] = $request->file('image')->extension();
        $galleryData['image_width'] = getimagesize($request->file('image'))[0];
        $galleryData['image_height'] = getimagesize($request->file('image'))[1];
        $galleryData['image'] = $file;
        $galleryData['image_size'] = (filesize($request->file('image'))/1000).' kb';
        $galleryData['user_name'] = $request->name;
        // dd($galleryData);
        Gallery::create($galleryData);
        return response()->json([
            'success' => true,
            'redirect' => route('view-gallery')
        ]);
    }

    public function getImages()
    {
        return GalleryResource::collection(Gallery::orderBy('id', 'DESC')->get());
    }

    public function gallery()
    {
        return view('gallery');
    }
}
