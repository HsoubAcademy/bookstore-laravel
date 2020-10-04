<?php

namespace App\Traits;

trait ImageUploadTrait
{
    protected $image_path  = "app/public/images/covers";
    protected $img_height = 600;
    protected $img_width = 600;

    public function uploadImage($img)
    {
        $img_name = $this->imageName($img);

        \Image::make($img)->resize($this->img_width, $this->img_height)->save(storage_path($this->image_path.'/'.$img_name));

        return "images/covers/" . $img_name;
    }

    public function imageName($image)
    {
        return time().'-'.$image->getClientOriginalName();
    }
}