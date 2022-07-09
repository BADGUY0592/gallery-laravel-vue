<?php
namespace App\Helper;

use Image;

class GalleryHelper 
{
    public function get_image_location($image){
        $data = Image::make(public_path($image))->exif();
        if(isset($data['GPSLatitude'])) {
            $lat = eval('return ' . $data['GPSLatitude'][0] . ';')
                + (eval('return ' . $data['GPSLatitude'][1] . ';') / 60)
                + (eval('return ' . $data['GPSLatitude'][2] . ';') / 3600);
            $lng = eval('return ' . $data['GPSLongitude'][0] . ';')
                + (eval('return ' . $data['GPSLongitude'][1] . ';') / 60)
                + (eval('return ' . $data['GPSLongitude'][2] . ';') / 3600);
            return array('latitude'=>$lat, 'longitude'=>$lng);
        } else {
            return [];
        }
    }
}