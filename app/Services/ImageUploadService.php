<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class ImageUploadService
{
    public static function storeResized(UploadedFile $file, string $directory, int $maxWidth = 1200, int $quality = 75): string
    {
        $manager = new ImageManager(new Driver());
        $image = $manager->read($file->getRealPath());
        $image->scaleDown(width: $maxWidth);
        $encoded = $image->toJpeg($quality);

        $filename = $directory . '/' . uniqid() . '.jpg';
        Storage::disk('public')->put($filename, (string) $encoded);

        return $filename;
    }
}