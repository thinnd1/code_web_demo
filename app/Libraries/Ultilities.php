<?php

namespace App\Libraries;

use Carbon\Carbon;
use File;

class Ultilities
{

    public static function formatDate($date, $type = 0)
    {
        //input
        if($type == 0){
            $test =  Carbon::createFromFormat('d/m/Y', $date)->format('m/d/Y');
            return date("Y/m/d", strtotime($test));
        }
        if($type == 2){
            return date("d/m/Y", strtotime($date));
        }
        if($type == 3){
            if(empty($date)){
                return null;
            }
            $fomat = explode(' ', $date);
            $res =  Carbon::createFromFormat('d/m/Y', $fomat[0])->format('m/d/Y');
            $res .= $fomat[1];
            return date("Y/m/d H:i", strtotime($res));
        }
        return date("Y/m/d", strtotime($date));
    }

    public static function formatDateHMI($date)
    {
        //input
        // $test =  Carbon::createFromFormat('d/m/Y h:i:s', $date)->format('m/d/Y');
        return date("Y/m/d - h:i", strtotime($date));
    }


    public static function fomatDateTime($date)
    {
        $dateTime = explode(' ', $date);
        $dateFomat = self::formatDate($dateTime[0]);
        $dateTimeFomat = $dateFomat . '-' . $dateTime[1];
        return date("Y/m/d - h:i", strtotime($dateTimeFomat));
    }

    public static function uploadFile($file)
    {
        $publicPath = public_path('uploads');
        if (!File::exists($publicPath)) {
            File::makeDirectory($publicPath, 0775, true, true);
        }
        $name = time().'-eduzu-'.$file->getClientOriginalName();
        $name = preg_replace('/\s+/', '', $name);
        $file->move(public_path('uploads'), $name);
        return '/uploads/'.$name;
    }


    public static function clearXSS($string)
    {
        $string = nl2br($string);
        $string = trim(strip_tags($string));
        $string = self::removeScripts($string);

        return $string;
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
