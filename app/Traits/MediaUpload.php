<?php

namespace App\Traits;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

trait MediaUpload
{
    /**
     * Handle upload of single image
     *
     * @param mixed $image The image from form data
     * @param string $name Name of the image
     * @param string $dir location to store image i.e on disk storage
     * @return string
     **/
    public function uploadSingleImage(
            mixed $image,
            string $name = null,
            ?string $dir = null
        ): string
    {
        // store image string name
        $new_image_name = null;

        if (isset($image))
            $new_image_name = Cloudinary::upload($image->getRealPath())->getSecurePath();
            
        return $new_image_name;
    }

    /**
     * Handle upload of multiple images
     *
     * @param array $images The image from form data
     * @param string $name Name of the image
     * @param string $dir location to store image i.e on disk storage
     * @return string
     **/
    public function uploadMultipleImage(
            array $images,
            ?string $name,
            ?string $dir
        ): string
    {
        // array to store new image name
        $new_image_name_arr = [];

        if (isset($images)) {
            
            // Cloud Upload Storage
            foreach ($images as $image) {
                $new_image_name_arr[] = Cloudinary::upload($image->getRealPath())->getSecurePath();
            }
        }

        // create a storable string from the array of image names
        $serialized_images = serialize($new_image_name_arr);
        return $serialized_images;
    }

    public function storeAvatar(string $image, ?string $name, ?string $dir)
    {
        if (env('APP_ENV') == 'local') {
            $avatar_ext = "png";
            $avatar_name = strtolower($name)."-".time().".".$avatar_ext;
            Storage::disk('public')->put("{$dir}/{$avatar_name}", base64_decode($image));
        } else {
            $avatar_ext = "png";
            $avatar_id = strtolower($name)."-".time();
            Storage::disk('cloudinary')->put("{$dir}/{$avatar_id}.{$avatar_ext}", base64_decode($image));
            $avatar_name = Cloudinary::getUrl("{$dir}/{$avatar_id}");
        }

        return $avatar_name;
    }
}
