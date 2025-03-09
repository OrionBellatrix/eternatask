<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Exception;

final class ImageService
{
    protected ImageManager $imageManager;

    /**
     * @throws \Exception
     */
    public function __construct()
    {
        if (extension_loaded('imagick')) {
            $this->imageManager = ImageManager::imagick();
        }
        elseif (extension_loaded('gd')) {
            $this->imageManager = ImageManager::gd();
        }
        else {
            throw new Exception('Imagick or gd extension not loaded');
        }
    }

    /**
     * @param UploadedFile $file
     * @param int $width
     * @param int $height
     * @param string $path
     * @return string
     */
    public function uploadAndCrop(UploadedFile $file, int $width, int $height, string $path = 'images'): string
    {
        $filename = uniqid() . '.' . $file->getClientOriginalExtension();

        $image = $this->imageManager->read($file->getPathname())
            ->cover($width, $height);

        Storage::disk('public')->put("{$path}/{$filename}", (string) $image->encode());

        return "{$path}/{$filename}";
    }

    /**
     * @param string $path
     * @return void
     */
    public function deleteImage(string $path): void
    {
        Storage::disk('public')->delete($path);
    }
}
