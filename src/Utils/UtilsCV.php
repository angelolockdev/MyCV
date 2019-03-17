<?php
/**
 * Created by IntelliJ IDEA.
 * User: Angelo-KabyLake
 * Date: 16/03/2019
 * Time: 09:40
 */
namespace App\Utils;
use App\Entity\ResumeTitle;
use App\Entity\Resume;

class UtilsCV
{
    public static function convertToString(?\DateTimeInterface $dateTime): ?string{
        $dateTime = date_parse($dateTime->format('d-m-Y'));
        $ret = $dateTime['day']."-".$dateTime['month']."-".$dateTime['year'];
        return $ret ;
    }
    public static function converToArray(?\DateTimeInterface $dateTime): ?array {
        return date_parse($dateTime->format('d-m-Y'));
    }
    public function displayMonthYear(?\DateTimeInterface $dateTime): ?string{
        $dateTime = date_parse($dateTime->format('d-m-Y'));
        $ret = $this->getMonthLetters($dateTime['month']).' '.$dateTime['year'];
        return $ret;
    }
    public function getYear(?\DateTimeInterface $date): int
    {
        $age = date_parse($date->format('Y-m-d'));
        return (int) "".$age['year'];
    }
    public function getMonthLetters(int $month): ?string{
        $ret = null;
        switch ($month){
            case 1:
                $ret = "Janvier";break;
            case 2:
                $ret = "Février";break;
            case 3:
                $ret = "Mars";break;
            case 4:
                $ret = "Avril";break;
            case 5:
                $ret = "Mai";break;
            case 6:
                $ret = "Juin";break;
            case 7:
                $ret = "Juillet";break;
            case 8:
                $ret = "Août";break;
            case 9:
                $ret = "Septembre";break;
            case 10:
                $ret = "Octobre";break;
            case 11:
                $ret = "Novembre";break;
            default:
                $ret = "Décembre";
        }
        return $ret;
    }
    public static function getYearByDate(?\DateTimeInterface $date): int
    {
        $age = date_parse($date->format('Y-m-d'));
        return (int) "".$age['year'];
    }

}