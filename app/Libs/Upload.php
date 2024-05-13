<?php

namespace App\Libs;
use Illuminate\Http\Request;
use Storage;
use Str;

class Upload {

	public static function uploadImage($folder = 'upload', $file) {
		$file_origin = $file->getClientOriginalName();
		$filename = pathinfo($file_origin, PATHINFO_FILENAME);
		$extension = pathinfo($file_origin, PATHINFO_EXTENSION);
		$storage = Storage::disk('public');

        $file_name = $folder .'/'.Str::slug($filename).'-'.time().'.'.$extension;

        $storage->put($file_name, file_get_contents($file));
        $url = Storage::url($file_name);
        return $url;
	}

}
