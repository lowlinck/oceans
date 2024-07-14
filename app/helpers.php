<?php
if(!function_exists('getCasheKey')) {
    function getCasheKey($data): string
    {
        return md5(json_encode($data));
    }
}
