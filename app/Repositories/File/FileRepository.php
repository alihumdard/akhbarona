<?php
namespace App\Repositories\File;
interface FileRepository {
    function checkFile($size,$image,$md5);
    function getLarge($image,$checkExisting=true,$md5='');
    function getMedium($image,$checkExisting=true,$md5='');
    function getSmall($image,$checkExisting=true,$md5='');
    function getSummaryLarge($image,$checkExisting=true,$md5='');
    function getSummaryMedium($image,$checkExisting=true,$md5='');
    function getSummarySmall($image,$checkExisting=true,$md5='');
    function getThumbview($image,$checkExisting=true,$md5='');
    function getDesktopUrl($image);
    function getMobileUrl($image);
    function getImage($image);
}
