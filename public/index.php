<?php

require('../vendor/autoload.php');

$url = isset($_GET['url']) ? $_GET['url'] : null;

function send_json($data)
{
    header('Content-Type: application/json');
    echo json_encode($data, JSON_PRETTY_PRINT);
    exit;
}

if (!$url) {
    send_json([
        'error' => 'No URL provided!'
    ]);
}

$youtube = new \YouTube\YouTubeDownloader();

try {
    $links = $youtube->getDownloadLinks($url);

    $best = $links->getFirstCombinedFormat();

$img = "https://i.ytimg.com/vi/".$id."/hqdefault.jpg";



$bitrate = $best->contentLength;

if ($bitrate >= 1073741824) {

            $bitrate = number_format($bitrate / 1073741824, 2) . ' GB';

        } elseif ($bitrate >= 1048576) {

            $bitrate = number_format($bitrate / 1048576, 2) . ' MB';

        } elseif ($bitrate >= 1024) {

            $bitrate = number_format($bitrate / 1024, 2) . ' KB';

        } elseif ($bitrate > 1) {

            $bitrate = $bitrate . ' bytes';

        } elseif ($bitrate === 1) {

            $bitrate = $bitrate . ' byte';

        } else {

            $bitrate = '0 bytes';

        }


    if ($best) {
        send_json([
            'links' => [
             'url'=> $best->url,
             'sizebet'=> $best->contentLength,
    'title' => $title,
    'img' => $img,
    'view_count' => $view_count,
    'duration' => covtime($VidDuration),
    'like_count' => $like_count,
    'dislike_count' => $dislike_count,
    //'sizebet' => $links[0]["sizebet"],
    'size' => $bitrate,
    'Name API' => "AymanEGY",
              ],
        ]);
    } else {
        send_json(['error' => 'No links found']);
    }

} catch (\YouTube\Exception\YouTubeException $e) {

    send_json([
        'error' => $e->getMessage()
    ]);
}
