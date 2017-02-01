<?php

function img_resize( $tmpname, $size, $save_dir, $save_name ) 
    { 
    $save_dir .= ( substr($save_dir,-1) != "/") ? "/" : ""; 
        $gis       = GetImageSize($tmpname); 
    $type       = $gis[2]; 
    switch($type) 
        { 
        case "1": $imorig = imagecreatefromgif($tmpname); break; 
        case "2": $imorig = imagecreatefromjpeg($tmpname);break; 
        case "3": $imorig = imagecreatefrompng($tmpname); break; 
        default:  $imorig = imagecreatefromjpeg($tmpname); 
        } 

        $x = imageSX($imorig); 
        $y = imageSY($imorig); 
        if($gis[0] <= $size) 
        { 
        $av = $x; 
        $ah = $y; 
        } 
            else 
        { 
            $yc = $y*1.3333333; 
            $d = $x>$yc?$x:$yc; 
            $c = $d>$size ? $size/$d : $size; 
              $av = $x*$c;        //?????? ???????? ???????? 
              $ah = $y*$c;        //????? ???????? ???????? 
        }    
        $im = imagecreate($av, $ah); 
        $im = imagecreatetruecolor($av,$ah); 
    if (imagecopyresampled($im,$imorig , 0,0,0,0,$av,$ah,$x,$y)) 
        if (imagejpeg($im, $save_dir.$save_name)) 
            return true; 
            else 
            return false; 
    }

function formatBytes($size, $precision = 0) //usage: echo formatBytes(24962496)
	{
		$base = log($size, 1024);
		$suffixes = array('', 'KB', 'MB', 'GB', 'TB');   

		return round(pow(1024, $base - floor($base)), $precision) .' '. $suffixes[floor($base)];
	}



?>