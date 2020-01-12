<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 5/13/2019
 * Time: 10:32 PM
 */

namespace App\Classes;


class AllIcons
{
    public function web() {
        return [
            "icon_set_1_icon-1",
            "icon_set_1_icon-2",
            "icon_set_1_icon-3",
            "icon_set_1_icon-4",
            "icon_set_1_icon-5",
            "icon_set_1_icon-6",
            "icon_set_1_icon-7",
            "icon_set_1_icon-8",
            "icon_set_1_icon-9",
            "icon_set_1_icon-10",
            "icon_set_1_icon-11",
            "icon_set_1_icon-12",
            "icon_set_1_icon-13",
            "icon_set_1_icon-14",
            "icon_set_1_icon-15",
            "icon_set_1_icon-16",
            "icon_set_1_icon-17",
            "icon_set_1_icon-18",
            "icon_set_1_icon-19",
            "icon_set_1_icon-20",
            "icon_set_1_icon-21",
            "icon_set_1_icon-22",
            "icon_set_1_icon-23",
            "icon_set_1_icon-24",
            "icon_set_1_icon-25",
            "icon_set_1_icon-26",
            "icon_set_1_icon-27",
            "icon_set_1_icon-28",
            "icon_set_1_icon-29",
            "icon_set_1_icon-30",
            "icon_set_1_icon-31",
            "icon_set_1_icon-32",
            "icon_set_1_icon-33",
            "icon_set_1_icon-34",
            "icon_set_1_icon-35",
            "icon_set_1_icon-36",
            "icon_set_1_icon-37",
            "icon_set_1_icon-38",
            "icon_set_1_icon-39",
            "icon_set_1_icon-40",
            "icon_set_1_icon-41",
            "icon_set_1_icon-42",
            "icon_set_1_icon-43",
            "icon_set_1_icon-44",
            "icon_set_1_icon-45",
            "icon_set_1_icon-46",
            "icon_set_1_icon-47",
            "icon_set_1_icon-48",
            "icon_set_1_icon-49",
            "icon_set_1_icon-50",
            "icon_set_1_icon-51",
            "icon_set_1_icon-52",
            "icon_set_1_icon-53",
            "icon_set_1_icon-54",
            "icon_set_1_icon-55",
            "icon_set_1_icon-56",
            "icon_set_1_icon-57",
            "icon_set_1_icon-58",
            "icon_set_1_icon-59",
            "icon_set_1_icon-60",
            "icon_set_1_icon-61",
            "icon_set_1_icon-62",
            "icon_set_1_icon-63",
            "icon_set_1_icon-64",
            "icon_set_1_icon-65",
            "icon_set_1_icon-66",
            "icon_set_1_icon-67",
            "icon_set_1_icon-68",
            "icon_set_1_icon-69",
            "icon_set_1_icon-70",
            "icon_set_1_icon-71",
            "icon_set_1_icon-72",
            "icon_set_1_icon-73",
            "icon_set_1_icon-74",
            "icon_set_1_icon-75",
            "icon_set_1_icon-76",
            "icon_set_1_icon-77",
            "icon_set_1_icon-78",
            "icon_set_1_icon-79",
            "icon_set_1_icon-80",
            "icon_set_1_icon-81",
            "icon_set_1_icon-82",
            "icon_set_1_icon-83",
            "icon_set_1_icon-84",
            "icon_set_1_icon-85",
            "icon_set_1_icon-86",
            "icon_set_1_icon-87",
            "icon_set_1_icon-88",
            "icon_set_1_icon-89",
            "icon_set_1_icon-90",
            "icon_set_1_icon-91",
            "icon_set_1_icon-92",
            "icon_set_1_icon-93",
            "icon_set_1_icon-94",
            "icon_set_1_icon-95",
            "icon_set_1_icon-96",
            "icon_set_1_icon-97",
            "icon_set_1_icon-98",
            "icon_set_1_icon-99",
            "icon_set_1_icon-100",
            "icon_set_2_icon-102",
            "icon_set_2_icon-103",
            "icon_set_2_icon-104",
            "icon_set_2_icon-105",
            "icon_set_2_icon-106",
            "icon_set_2_icon-107",
            "icon_set_2_icon-108",
            "icon_set_2_icon-109",
            "icon_set_2_icon-110",
            "icon_set_2_icon-111",
            "icon_set_2_icon-112",
            "icon_set_2_icon-114",
            "icon_set_2_icon-115",
            "icon_set_2_icon-116",
            "icon_set_2_icon-117",
            "icon_set_2_icon-118"
        ];
    }

    /**
     * Decrease or increase the quality of an image without resize it.
     *
     * @param type $source
     * @param type $destination
     * @param type $quality
     * @return type
     */
    function compress($source, $destination, $quality) {
        //Get file extension
        $exploding = explode(".",$source);
        $ext = end($exploding);

        switch($ext){
            case "png":
                $src = imagecreatefrompng($source);
                break;
            case "jpeg":
            case "jpg":
                $src = imagecreatefromjpeg($source);
                break;
            case "gif":
                $src = imagecreatefromgif($source);
                break;
            default:
                $src = imagecreatefromjpeg($source);
                break;
        }

        switch($ext){
            case "png":
                imagepng($src, $destination, $quality);
                break;
            case "jpeg":
            case "jpg":
                imagejpeg($src, $destination, $quality);
                break;
            case "gif":
                imagegif($src, $destination, $quality);
                break;
            default:
                imagejpeg($src, $destination, $quality);
                break;
        }

        return $destination;
    }

    /**
     * Resize image given a height and width and return raw image data.
     *
     * Note : You can add more supported image formats adding more parameters to the switch statement.
     *
     * @param type $file filepath
     * @param type $w width in px
     * @param type $h height in px
     * @param type $crop Crop or not
     * @return type
     */
    function resize_image($file, $w, $h, $crop=false) {
        list($width, $height) = getimagesize($file);
        $r = $width / $height;
        if ($crop) {
            if ($width > $height) {
                $width = ceil($width-($width*abs($r-$w/$h)));
            } else {
                $height = ceil($height-($height*abs($r-$w/$h)));
            }
            $newwidth = $w;
            $newheight = $h;
        } else {
            if ($w/$h > $r) {
                $newwidth = $h*$r;
                $newheight = $h;
            } else {
                $newheight = $w/$r;
                $newwidth = $w;
            }
        }

        //Get file extension
        $exploding = explode(".",$file);
        $ext = end($exploding);

        switch($ext){
            case "png":
                $src = imagecreatefrompng($file);
                break;
            case "jpeg":
            case "jpg":
                $src = imagecreatefromjpeg($file);
                break;
            case "gif":
                $src = imagecreatefromgif($file);
                break;
            default:
                $src = imagecreatefromjpeg($file);
                break;
        }

        $dst = imagecreatetruecolor($w, $h);
        imagecopyresampled($dst, $src, 0, 0, 0, 0, $w, $h, $width, $height);

        return $dst;
    }
}