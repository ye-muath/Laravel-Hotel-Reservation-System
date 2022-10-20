<?php

namespace App\Services;
use Pishran\PersianString\PersianString;
use App\Interfaces\ConvertServiceInterface;
use Illuminate\Support\Facades\Log;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use Illuminate\Support\Facades\Storage;

class ConvertService implements ConvertServiceInterface
{
    //****** this service contains all method for convert format ******//

    //convert excel data to array
    public function ExcelToArray(string $filePath): array
    {
        $reader = new Xlsx();
        $data = $reader->load(Storage::path('public/' . $filePath));
        return $data->getActiveSheet()->toArray();
    }

    //convert letter words to persion
    function to_fa_letter($string) {

        $arabic_letters = ['ي', 'ك', 'ؤ', 'ۀ'];

        $persian_letters = ['ی', 'ک', 'و', 'ه'];

        return str_replace($arabic_letters, $persian_letters, $string);
    }

    //convert arabic words to persion
    public function ArabicWordToPersian($string)
    {
        return $this->to_fa_letter(trim($string));
    }
}