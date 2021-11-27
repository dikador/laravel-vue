<?php

namespace App\Traits\Eloquent;

use Illuminate\Support\Facades\Storage;

trait Uploadable
{
   static public function uploadFile($file, $storage = 'public', $folder = 'uploads')
   {
      $filename = uniqid() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
      $path = Storage::disk($storage)->putFileAs($folder, $file, $filename);

      if (Storage::disk($storage)->exists($path)) {
         return '../storage/' . $path;
      }

      return null;
   }

   static public function deleteFile($file, $storage = 'public')
   {
      $filename = str_replace('../storage/', '', $file);
      $path = Storage::disk($storage)->delete($filename);

      return $path;
   }
}
