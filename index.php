<?php
include 'settings.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Simon's Kiln Page</title>
    <link rel="stylesheet" type="text/css" href="style.css?v=2">

    <script src="https://code.jquery.com/jquery-1.10.1.min.js"></script> 
    <script src="https://www.gstatic.com/firebasejs/4.0.0/firebase.js"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>

</head>
<body>

<div id="container" ></div>

<h2 id="templabel">
<?php
$sql = "SELECT *, ADDTIME(ts,'0 2:00:00') as tss FROM logger where field = 't' order by ts desc limit 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {       
        echo "now: ".$row["val"]. " degrees.<br />:)";
    }
} else {
    echo "0 results";
}
?>
</h2>
<div id="lastupdated"></div>

<div class="topcorner" onclick="window.location.href = 'https://github.com/cledwyn/simonskiln'">
    <img src="img/Octocat.jpg" alt="about" style="height: 15px">
</div>

<script src="script.js"></script>

<div style="width: 100%;display: flex;align-items: center;justify-content: center;padding-top: 20px;">
<script async src="https://d36hc0p18k1aoc.cloudfront.net/pages/a5b5e5.js"></script><div class="tintup" data-id="simonskiln" data-columns="" data-expand="true"    data-infinitescroll="true" data-personalization-id="863260" style="height:500px;width:100%;"></div>
<!-- <blockquote class="instagram-media" data-instgrm-captioned data-instgrm-version="7" style=" background:#FFF; border:0; border-radius:3px; box-shadow:0 0 1px 0 rgba(0,0,0,0.5),0 1px 10px 0 rgba(0,0,0,0.15); margin: 1px; max-width:658px; padding:0; width:99.375%; width:-webkit-calc(100% - 2px); width:calc(100% - 2px);"><div style="padding:8px;"> <div style=" background:#F8F8F8; line-height:0; margin-top:40px; padding:50.0% 0; text-align:center; width:100%;"> <div style=" background:url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACwAAAAsCAMAAAApWqozAAAABGdBTUEAALGPC/xhBQAAAAFzUkdCAK7OHOkAAAAMUExURczMzPf399fX1+bm5mzY9AMAAADiSURBVDjLvZXbEsMgCES5/P8/t9FuRVCRmU73JWlzosgSIIZURCjo/ad+EQJJB4Hv8BFt+IDpQoCx1wjOSBFhh2XssxEIYn3ulI/6MNReE07UIWJEv8UEOWDS88LY97kqyTliJKKtuYBbruAyVh5wOHiXmpi5we58Ek028czwyuQdLKPG1Bkb4NnM+VeAnfHqn1k4+GPT6uGQcvu2h2OVuIf/gWUFyy8OWEpdyZSa3aVCqpVoVvzZZ2VTnn2wU8qzVjDDetO90GSy9mVLqtgYSy231MxrY6I2gGqjrTY0L8fxCxfCBbhWrsYYAAAAAElFTkSuQmCC); display:block; height:44px; margin:0 auto -44px; position:relative; top:-22px; width:44px;"></div></div> <p style=" margin:8px 0 0 0; padding:0 4px;"> <a href="https://www.instagram.com/p/BUagBqKACv-/" style=" color:#000; font-family:Arial,sans-serif; font-size:14px; font-style:normal; font-weight:normal; line-height:17px; text-decoration:none; word-wrap:break-word;" target="_blank">Amazing Friend. My buddy @lloydlentz and I have been fiddling with a data logging cellular pyrometer. We just finally got it all hooked it up three days into our workshop firing. Its held together with hen&#39;s teeth and macguyver juice. What this means is you can go to the link in my profile SimonsKiln.com and follow along. The pyrometer is located in the front firebox. Though it is reading around 1900 we are holding it at cone 8 in the front. I am totally excited about this new toy. @lloydlentz is a steely eyed missile man. The next firing we will be able to graph the front middle and rear of the big kiln. Visit the site, and follow along. @treverbubba @paulstokstad @cartersclay @jacobmeer @ianjconnors are all posting from the workshop. #macguyver #woodfire #mca2017 #dataloggingpyro #amazingfriends</a></p> <p style=" color:#c9c8cd; font-family:Arial,sans-serif; font-size:14px; line-height:17px; margin-bottom:0; margin-top:8px; overflow:hidden; padding:8px 0 7px; text-align:center; text-overflow:ellipsis; white-space:nowrap;">A post shared by Simon Levin (@woodfire) on <time style=" font-family:Arial,sans-serif; font-size:14px; line-height:17px;" datetime="2017-05-23T00:04:14+00:00">May 22, 2017 at 5:04pm PDT</time></p></div></blockquote>  -->
</div>

<!-- <script async defer src="//platform.instagram.com/en_US/embeds.js"></script> -->

</body>
</html>