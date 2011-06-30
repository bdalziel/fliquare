<?php

require('/home/content/53/8018853/html/lib/template.php');

$color = htmlspecialchars($_GET["color"]);

$u_color = ucfirst($color);

$body = '';

if (!$color)
{
  // No color given. Sigh
  $body = <<<HTML

<div id="doc" class="yui-t4">
  <div id="card-container">
    <div id="card">
      <h1>Add some color</h1>
      <h2><a href="?color=blue" title="Blue Square">blue</a></h2>
      <h2><a href="?color=red" title="Red Square">red</a></h2>
      <h2><a href="?color=green" title="Green Square">green</a></h2>
    </div>
  </div>
</div>

HTML;

}
else
{

  $flickr_photos = '';

  $query = "http://query.yahooapis.com/v1/public/yql?q=select%20source%2C%20url%20from%20flickr.photos.sizes%20where%20photo_id%20in%20(select%20id%20from%20flickr.photos.search(60)%20where%20text%3D%22" . $color . "%22%20and%20sort%3D%22relevance%22%20and%20privacy_filter%3D%221%22%20and%20content_type%3D%221%22%20and%20safe_search%3D%221%22)%20and%20label%3D%22Square%22";

  $query_display = "YQL Query Structure: " . $query;

  //print $query_display;

  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $query);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_TIMEOUT, 5);
  $data = curl_exec($ch);
  $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
  curl_close($ch);

  if (!($httpcode>=200 && $httpcode<300))
  {
    // Bad req
    $color = "Bad color";
    $u_color = "Bad color";
  }
  else
  {
    $flickr_photos = render_flickr_photos(simplexml_load_string($data));
  }

  $body = <<<HTML

<div id="doc" class="yui-t4">
  <div id="color-container" class="card-image">
    {$flickr_photos}
  </div>
  <div id="card-container">
    <div id="card">
      <h1>{$u_color}</h1>
    </div>
  </div>
</div>

HTML;
}

$title = "Flickr Color Block";
if ($color)
{
  $title = $u_color . " | " . $title;
}

$assembled_page = assemble_page($body, $title);

print $assembled_page;








function render_flickr_photos ($data) {

  $flickr_photos = '';

  $photo_row = '';
  $photo_index = 0;
  
  foreach ($data->results->size as $result) {
    $result_attributes = $result->attributes();
    $img_src = strval($result_attributes['source']);

    if ($photo_index >= 10)
    {
      $photo_index = 0;
      $flickr_photos .= <<<HTML
<div class="flickr-row">{$photo_row}</div>
HTML;
      $photo_row = '';
    }

    $photo_row .= <<<HTML
<img src="{$img_src}" width="77" height="74" />
HTML;
    $photo_index++;
  }

  if ($photo_row)
  {
    $flickr_photos .= <<<HTML
<div class="flickr-row">{$photo_row}</div>
HTML;
  }

  return $flickr_photos;
}

?>
