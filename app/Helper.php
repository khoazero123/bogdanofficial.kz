<?php // Code within app\Helpers\Helper.php

namespace App\Helpers;

class Helper
{

    static public function date_standard($datetime){
        return date("d.m.Y H:i:s", strtotime($datetime));
    }


    static public function getRequest ()
    {
        global $HTTP_RAW_POST_DATA;

        if (isset($_POST['pg_xml'])) {
            $inData['pg_xml'] = $_POST['pg_xml'];
        }
        elseif (isset($_POST['pg_sig'])) {
            $inData = $_POST;
        }
        elseif (isset($_GET['pg_sig'])) {
            $inData = $_GET;
        }
        elseif ( !empty($HTTP_RAW_POST_DATA) ) {
            $inData['pg_xml'] = $HTTP_RAW_POST_DATA;
        }
        elseif ( ($HTTP_RAW_POST_DATA = file_get_contents("php://input")) ) {
            // get HTTP_RAW_POST_DATA if it is not set in php.ini to always_populate_raw_post_data
            $inData['pg_xml'] = $HTTP_RAW_POST_DATA;
        }
        else
            return null;

        return $inData;

    }



    public static function  generate_chpu ($str)
    {
        $converter = array();
        $converter['А']='a';     $converter['а']='a';
        $converter['Б']='b';     $converter['б']='b';
        $converter['В']='v';     $converter['в']='v';
        $converter['Г']='g';     $converter['г']='g';
        $converter['Д']='d';     $converter['д']='d';
        $converter['Е']='e';     $converter['е']='e';
        $converter['Ё']='yo';    $converter['ё']='yo';
        $converter['Ж']='zh';    $converter['ж']='zh';
        $converter['З']='z';     $converter['з']='z';
        $converter['И']='i';     $converter['и']='i';
        $converter['Й']='j';     $converter['й']='j';
        $converter['К']='k';     $converter['к']='k';
        $converter['Л']='l';     $converter['л']='l';
        $converter['М']='m';     $converter['м']='m';
        $converter['Н']='n';     $converter['н']='n';
        $converter['О']='o';     $converter['о']='o';
        $converter['П']='p';     $converter['п']='p';
        $converter['Р']='r';     $converter['р']='r';
        $converter['С']='s';     $converter['с']='s';
        $converter['Т']='t';     $converter['т']='t';
        $converter['У']='u';     $converter['у']='u';
        $converter['Ф']='f';     $converter['ф']='f';
        $converter['Х']='x';     $converter['х']='x';
        $converter['Ц']='c';     $converter['ц']='c';
        $converter['Ч']='ch';    $converter['ч']='ch';
        $converter['Ш']='sh';    $converter['ш']='sh';
        $converter['Щ']='shh';   $converter['щ']='shh';
        $converter['Ъ']='"';     $converter['ъ']='"';
        $converter['Ы']='y';     $converter['ы']='y';
        $converter['Ь']='';      $converter['ь']='';
        $converter['Э']='e';     $converter['э']='e';
        $converter['Ю']='yu';    $converter['ю']='yu';
        $converter['Я']='ya';    $converter['я']='ya';
        $converter[' ']='-';
        
        $str = strtr($str, $converter);
        $str = strtolower($str);
        $str = preg_replace('~[^-a-z0-9_]+~u', '-', $str);
        $str = trim($str, "-");
        return $str;
    }

    //обрезание текста
    public static function limit_text($text, $limit){
        //$text = strip_tags($text);
        $words = explode(' ', $text); // создаём из строки массив слов
        if ($limit < 1 || sizeof($words) <= $limit) { // если лимит указан не верно или количество слов меньше лимита, то возвращаем исходную строку
            $limit =  sizeof($words);
        }
        $words = array_slice($words, 0, $limit); // укорачиваем массив до нужной длины
        $out = implode(' ', $words);

        return self::closetags($out); //возвращаем строку + символ/строка завершения
    }

    public static function  closetags($html) {
        preg_match_all('#<(?!meta|img|br|hr|input\b)\b([a-z]+)(?: .*)?(?<![/|/ ])>#iU', $html, $result);
        $openedtags = $result[1];
        preg_match_all('#</([a-z]+)>#iU', $html, $result);
        $closedtags = $result[1];
        $len_opened = count($openedtags);
        if (count($closedtags) == $len_opened) {
            return $html;
        }
        $openedtags = array_reverse($openedtags);
        for ($i=0; $i < $len_opened; $i++) {
            if (!in_array($openedtags[$i], $closedtags)) {
                $html .= '</'.$openedtags[$i].'>';
            } else {
                unset($closedtags[array_search($openedtags[$i], $closedtags)]);
            }
        }
        return $html;
    }

    public static function p($array) {
        echo '<pre>';
        print_r($array);
        echo '</pre>';
    }
}

?>