<?php 
namespace Savers\Bank\Validations;

class ValidPersonID {
    public static function isValidPersonId($personId){
        $year = $personId[1] . $personId[2]; 
        $month = $personId[3] . $personId[4];
        $day = $personId[5] . $personId[6];
        function dayRange($month ){
            if ($month == '02'){
                return range(1, 29);
            }
            else if($month == '04' || $month == '06' || $month == '09' || $month == '11') {
                return range(1, 30);
            } else {
                return range(1, 31);
            }
        }
        if (strlen($personId) != 11
        || !in_array($personId[0], range(3, 4))
        || !in_array($month, range(1, 12))
        || !in_array($day, dayRange($month))){
            return false;
        }
        else {
            return true;
        }
    }
}
