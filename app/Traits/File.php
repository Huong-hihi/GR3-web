<?php
namespace App\Traits;


class File
{
    public function saveFileToLocal($request, $inputName, $path): string
    {
        if ($request->hasFile($inputName)) {
            $file= $request->file($inputName);
            $fileName= date('YmdHis') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path($path), $fileName);
        }

        return $fileName ?? false;
    }
}
