<?php

require('../vendor/autoload.php');

$url = isset($_GET['url']) ? $_GET['url'] : null;
if(preg_match('/(http(s|):|)\/\/(www\.|)yout(.*?)\/(embed\/|watch.*?v=|)([a-z_A-Z0-9\-]{11})/i', $url)){
function getYoutubeIdFromUrl($url) {
    $parts = parse_url($url);
    if(isset($parts['query'])){
        parse_str($parts['query'], $qs);
        if(isset($qs['v'])){
            return $qs['v'];
        }else if(isset($qs['vi'])){
            return $qs['vi'];
        }}}}
      $id = getYoutubeIdFromUrl($url);
$getinfo = json_decode(file_get_contents("https://www.googleapis.com/youtube/v3/videos?part=snippet%2CcontentDetails%2Cstatistics&id=".$id."&key=AIzaSyAAr5xTBdLRiIUMvJPK4vUUEH6VlNwRiZY"))->items[0];
$title = $getinfo->snippet->title;
$view_count = $getinfo->statistics->viewCount;
$duration = $getinfo->contentDetails->duration;
$like_count = $getinfo->statistics->likeCount;
$dislike_count = $getinfo->statistics->dislikeCount;
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

$VidDuration = $getinfo->contentDetails->duration;

function covtime($yt){

    $yt=str_replace(['P','T'],'',$yt);

    foreach(['D','H','M','S'] as $a){

        $pos=strpos($yt,$a);

        if($pos!==false) ${$a}=substr($yt,0,$pos); else { ${$a}=0; continue; }

        $yt=substr($yt,$pos+1);

    }

    if($D>0){

        $M=str_pad($M,2,'0',STR_PAD_LEFT);

        $S=str_pad($S,2,'0',STR_PAD_LEFT);

        return ($H+(24*$D)).":$M:$S"; // add days to hours

    } elseif($H>0){

        $M=str_pad($M,2,'0',STR_PAD_LEFT);

        $S=str_pad($S,2,'0',STR_PAD_LEFT);

        return "$H:$M:$S";

    } else {

        $S=str_pad($S,2,'0',STR_PAD_LEFT);

        return "$M:$S";

    }

}
    if ($best) {
        send_json([
            'links' => [
             'url'=> $best->url,
    'title' => $title,
    'img' => $img,
    'view_count' => $view_count,
    'duration' => covtime($VidDuration),
    'like_count' => $like_count,
    'dislike_count' => $dislike_count,
    'sizebet' => $best->contentLength,
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
