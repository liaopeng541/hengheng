<?php
/**
 * Created by PhpStorm.
 * User: liao
 * Date: 2018/3/7
 * Time: 下午12:14
 */
function R($status,$message="",$data=null)
{
    header('Content-type: application/json');
    is_array($status) and die(json_encode($status));
    die(json_encode(["status"=>$status,"message"=>$message,"data"=>$data]));
}
function P($key)
{
    $data = isset($_POST[$key])?$_POST[$key]:null;
    return $data;
}
function ThrowError($code,$message,$data=null)
{
    throw new \common\service\ErrorServer($message,$code,$data);
}
function SendExcelFile($file_data)
{
    $file_name=date("YmdHis").rand(1000,9999)."xls";
    header("Content-type:text/csv;");
    header("Content-Disposition:attachment;filename=" . $file_name);
    header('Cache-Control:must-revalidate,post-check=0,pre-check=0');
    header('Expires:0');
    header('Pragma:public');
    $csv_data = mb_convert_encoding($file_data, "cp936", "UTF-8");
    die($csv_data);
}
function filter_utf8_char($ostr){
    preg_match_all('/[\x{FF00}-\x{FFEF}|\x{0000}-\x{00ff}|\x{4e00}-\x{9fff}]+/u', $ostr, $matches);
    $str = join('', $matches[0]);
    if($str==''){   //含有特殊字符需要逐個處理
        $returnstr = '';
        $i = 0;
        $str_length = strlen($ostr);
        while ($i<=$str_length){
            $temp_str = substr($ostr, $i, 1);
            $ascnum = Ord($temp_str);
            if ($ascnum>=224){
                $returnstr = $returnstr.substr($ostr, $i, 3);
                $i = $i + 3;
            }elseif ($ascnum>=192){
                $returnstr = $returnstr.substr($ostr, $i, 2);
                $i = $i + 2;
            }elseif ($ascnum>=65 && $ascnum<=90){
                $returnstr = $returnstr.substr($ostr, $i, 1);
                $i = $i + 1;
            }elseif ($ascnum>=128 && $ascnum<=191){ // 特殊字符
                $i = $i + 1;
            }else{
                $returnstr = $returnstr.substr($ostr, $i, 1);
                $i = $i + 1;
            }
        }
        $str = $returnstr;
        preg_match_all('/[\x{FF00}-\x{FFEF}|\x{0000}-\x{00ff}|\x{4e00}-\x{9fff}]+/u', $str, $matches);
        $str = join('', $matches[0]);
    }
    return $str;
}