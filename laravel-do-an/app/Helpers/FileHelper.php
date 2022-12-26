<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;
use Str;

class FileHelper
{
    public static function deleteDirectory($dir) {
        if (!file_exists($dir)) {
            return true;
        }
    
        if (!is_dir($dir)) {
            return unlink($dir);
        }
    
        foreach (scandir($dir) as $item) {
            if ($item == '.' || $item == '..') {
                continue;
            }
    
            if (!self::deleteDirectory($dir . DIRECTORY_SEPARATOR . $item)) {
                return false;
            }
    
        }
    
        return rmdir($dir);
    }

    public static function uploadFile($file, $folder, $disk = 'public', $randomNumber = 20)
    {
        $mime = strtolower(@end(explode('.',$file->getClientOriginalName())));
        $fileName = time() . '-' . Str::random($randomNumber).'.'.$mime;
        $storage = Storage::disk($disk);
        $checkDirectory = $storage->exists($folder);
        if (!$checkDirectory) {
            $storage->makeDirectory($folder);
        }
        $storage->put("$folder/$fileName", file_get_contents($file));
        return [
            'fileName' => $fileName,
            'extension' => $mime,
        ];
    }

    public static function deleteFile($fileName, $folder, $disk = 'public')
    {
        $storage = Storage::disk($disk);
        $checkFile = $storage->exists("$folder/$fileName");
        if ($checkFile) {
            $storage->delete("$folder/$fileName");
        }
    }

    public static function downloadFile($fileName, $folder, $disk = 'public')
    {
        return  Storage::disk($disk)->download("$folder/$fileName");
    }

    public static function renderMimeType($mime)
    {
        $mimes = [
            "msword" => 'doc',
            "vnd.openxmlformats-officedocument.wordprocessingml.document" => 'docx',
            "vnd.ms-word.document.macroEnabled.12" => 'docm',
            "vnd.openxmlformats-officedocument.wordprocessingml.template" => 'dotx',
            "vnd.ms-word.template.macroEnabled.12" => 'dotm',
            "vnd.openxmlformats-officedocument.spreadsheetml.sheet" => 'xlsx',
            "vnd.ms-excel.sheet.macroEnabled.12" => 'xlsm',
            "vnd.openxmlformats-officedocument.spreadsheetml.template" => 'xltx',
            "vnd.ms-excel.template.macroEnabled.12" => 'xltm',
            "vnd.ms-excel.sheet.binary.macroEnabled.12" => 'xlsb',
            "vnd.ms-excel.addin.macroEnabled.12" => 'xlam',
            "vnd.openxmlformats-officedocument.presentationml.presentation" => 'pptx',
            "vnd.ms-powerpoint.presentation.macroEnabled.12" => 'pptm',
            "vnd.openxmlformats-officedocument.presentationml.slideshow" => 'ppsx',
            "vnd.ms-powerpoint.slideshow.macroEnabled.12" => 'ppsm',
            "vnd.openxmlformats-officedocument.presentationml.template" => 'potx',
            "vnd.ms-powerpoint.template.macroEnabled.12" => 'potm',
            "vnd.ms-powerpoint.addin.macroEnabled.12" => 'ppam',
            "vnd.openxmlformats-officedocument.presentationml.slide" => 'sldx',
            "vnd.ms-powerpoint.slide.macroEnabled.12" => 'sldm',
            "msonenote" => 'one',
            "msonenote" => 'onetoc2',
            "msonenote" => 'onetmp',
            "msonenote" => 'onepkg',
            "vnd.ms-officetheme" => 'thmx',
            "x-msdownload" => "exe"
        ];
        return !empty($mimes[$mime]) ? $mimes[$mime] : $mime;
    }
}
