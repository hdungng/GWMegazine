<?php

namespace App\Http\Controllers;

use App\Models\Contribution;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use ZipArchive;

class DownloadController extends Controller
{
    //
    public function downloadFile($id)
    {
        $zip = new ZipArchive();

        $contribution = Contribution::find($id);

        if (!$contribution) {
            toastr()->error('Contribution is not found!', 'Error', ['timeOut' => 5000]);
            return back();
        }

        $fileName = pathinfo($contribution->word_url, PATHINFO_FILENAME)  . '.zip';

        $cleanFileWordPath = str_replace('public/', '',  $contribution->word_url);


        if ($zip->open(public_path($fileName), ZipArchive::CREATE) === TRUE) {

            $zip->addFromString($contribution->title . '.docx', file_get_contents(public_path($cleanFileWordPath)));

            $zip->close();

            return response()->download(public_path($fileName))->deleteFileAfterSend(true);
        }
    }


    public function downloadFiles()
    {
        $zip = new ZipArchive();
        $fileName = 'all_contributions.zip';

        if ($zip->open(public_path($fileName), ZipArchive::CREATE) === TRUE) {


            $files = File::files(public_path('uploads/words'));

            foreach ($files as $file) {

                $nameInZipFile = basename($file);

                $zip->addFile($file, $nameInZipFile);
            }

            $zip->close();
        }

        return response()->download(public_path($fileName))->deleteFileAfterSend(true);
    }
}
