<?php

if (!function_exists('getImagePost')) {
    function getImagePost($post, $thumb = false)
    {
        $url = "storage/photos/{$post->account->id}/posts";
        return asset("{$url}/{$post->thumbnail}");
    }
}

if (!function_exists('formatDate')) {
    function formatDate($date)
    {
        return ucfirst(utf8_encode ($date->formatLocalized('%d %B %Y')));
    }
}
