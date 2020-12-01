<?php

namespace App\Libraries;

use Carbon\Carbon;
use File;

class Ultilities
{
    public static function uploadFile($file)
    {
        $publicPath = public_path('uploads');
        if (!File::exists($publicPath)) {
            File::makeDirectory($publicPath, 0775, true, true);
        }
        $name = time().'-'.$file->getClientOriginalName();
        $name = preg_replace('/\s+/', '', $name);
        $file->move(public_path('uploads'), $name);
        return '/uploads/'.$name;
    }

    public static function csvToArray($filename = '', $delimiter = ',')
    {
        if (!file_exists($filename) || !is_readable($filename))
            return false;

        $header = null;
        $data = array();
        if (($handle = fopen($filename, 'r')) !== false)
        {
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== false)
            {
                if (!$header){
                    $header = $row;
                } else
                    $data[] = array_combine($header, $row);
            }
            fclose($handle);
        }

        return $data;
    }

    public static function clearXSS($string)
    {
        $string = nl2br($string);
        $string = trim(strip_tags($string));
        $string = self::removeScripts($string);

        return $string;
    }

    public static function phoneStartsWith($str, $prefix, $pos = 0, $encoding = null)
    {
        if (is_null($encoding)) {
            $encoding = mb_internal_encoding();
        }
        return mb_substr($str, $pos, mb_strlen($prefix, $encoding), $encoding) === $prefix;
    }
    public static function replacePhone($phone)
    {
        if(empty($phone)){
            return $phone;
        }
        if  (!self::phoneStartsWith($phone, '+84') && !self::phoneStartsWith($phone, '84') && !self::phoneStartsWith($phone, '0')) {
            $phone = '0'.$phone;
            // dd($phone);
        }
        if ($phone == '') {
            return null;
        }
        $search = array('(84)', '(+84)', '+84', ' ', '-');
        $replace = array('0', '0', '0', '', '');
        $phone = str_replace($search, $replace, Ultilities::clearXSS($phone));
        $rest = substr($phone, 0,2);
        if($rest == '84'){
            $rest_phone = substr($phone ,2);
            $phone  = '0'.$rest_phone;
        }
        return $phone;
    }

}
