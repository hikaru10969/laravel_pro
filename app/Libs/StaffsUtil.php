<?php

/*
 * 共通パーツ
*/

namespace App\Libs;


class StaffsUtil
{
    // 所属値
    public static $job_list = ["0001"=> "エンジニア", "0002" => "営業", "0003" => "コーポレート"];
    // 新卒・中途
    public static $new_glad_flg = ["中途" => "0", "新卒" => "1"];


    /**
     * 中途新卒設定
     * $new_glad_flg int 0 or 1
     * return string 0:中途 1:新卒
     */
    public static function glad_flg($new_glad_flg) {
        if ($new_glad_flg == true){
            $new_glad_flg = "新卒";
        } else {
            $new_glad_flg = "中途";
        }
        return $new_glad_flg;
    }
}