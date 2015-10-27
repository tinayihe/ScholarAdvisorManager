<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Utils
 *
 * @author Yihe
 */
class Utils {
    public static function getProgrammeIdByLabel($programmeLabel) {
        $programmeId = false;
        switch ($programmeLabel) {
            case 'ISI':
                $programmeId = 1;
                break;
            case 'SM':
                $programmeId = 2;
                break;
            case 'MTE':
                $programmeId = 3;
                break;
            case 'SI':
                $programmeId = 4;
                break;
            case 'SRT':
                $programmeId = 5;
                break;
            case 'TC':
                $programmeId = 6;
                break;
            default:
                break;
        }
        return $programmeId;
    }
    
    public static function getEcNomPrenomByEcId($ec_id){
        
    }
}
