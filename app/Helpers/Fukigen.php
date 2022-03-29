<?php

use Illuminate\Support\Str;

/**
 * File upload dengan cara FukigenDev
 *
 * @param mixed $pathFileLocation lokasi tujuan
 * @param mixed $requestFile      request file dari form
 *
 * @return string nama-file.extensi
 */
if (!function_exists('upload_file')) {
    function upload_file($pathFileLocation, $requestFile)
    {
        (config('app.env') == 'local') ? $storage = '' : $storage = 'public/';

        $temporaryFileName = Str::uuid() . '.' .
            $requestFile->getClientOriginalExtension();

        $requestFile->move($storage . $pathFileLocation, $temporaryFileName);

        return $pathFileLocation . $temporaryFileName;
    }
}
