<?php

$markup = '';

$img_height = 74;
$img_width = 77;
$columns = 10;
$rows = 6;
$image_count = (int) ($columns * $rows);

$search = htmlspecialchars($_GET["search"]);
$u_search = ucfirst($search);

$o_fliquare = new FliQuare();

if (!$search)
{
  // No search given. Sigh
  $markup = "No search term given\n";
}
else
{
  $query = $o_fliquare->getQueryUrl($search, $image_count);
  $data = executeYqlQuery($query);
  if ($data)
  {
    $data = $o_fliquare->parseImageResultsIntoArray($data, $img_width, $img_height);
    $markup = $o_fliquare->renderFliQuare($data, $columns, $rows);
  }
}

print $markup;



function executeYqlQuery ($query, $timeout = 5) {
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $query);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
  $data = curl_exec($ch);
  $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
  curl_close($ch);    

  if ($httpcode>=200 && $httpcode<300)
  {
    return $data;
  }
  return null;
}

class FliQuare {

  public function __construct () {}

  public function getQueryUrl (/*string*/ $search_term, /*int*/ $count) {

    $host = "http://query.yahooapis.com";
    $path = "/v1/public/yql";

    // YQL query
    $query = $host . $path . "?q=select%20source%2C%20url%20from%20flickr.photos.sizes%20where%20photo_id%20in%20(select%20id%20from%20flickr.photos.search(" . $count . ")%20where%20text%3D%22" . $search_term . "%22%20and%20sort%3D%22relevance%22%20and%20privacy_filter%3D%221%22%20and%20content_type%3D%221%22%20and%20safe_search%3D%221%22)%20and%20label%3D%22Square%22";

    return $query;
  }

  public function parseImageResultsIntoArray ($data, $width = 77, $height = 77) {

    $ret = array();

    $data = simplexml_load_string($data);
    foreach ($data->results->size as $result) {
      $result_attributes = $result->attributes();
      $img_src = strval($result_attributes['source']);
      $img_url = strval($result_attributes['url']);
      $ret[] = array('url' => $img_url,
      	           'src' => $img_src,
                   'w'   => $width,
                   'h'   => $height
        );
    }
    return $ret;
  }

  public function renderFliQuare ($data, $cols = 4, $rows = 4) {

    $markup;
    $dataExhausted = false;

    for ($r = 0; $r < $rows && !$dataExhausted; $r++) {
      $row_markup = '';
      for ($c = 0; $c < $cols; $c++) {
        $index = $r*$cols + $c;
	if (!array_key_exists($index, $data))
	{
	  $dataExhausted = true;
          break;
	}

        $photo_data = $data[$index];
        $url = $photo_data["url"];
        $src = $photo_data["src"];
        $w = $photo_data["w"];
        $h = $photo_data["h"];

        // Render Photo
        $row_markup .= <<<HTML
<a href="{$url}"><img src="{$src}" width="{$w}" height="{$h}" /></a>
HTML;
      }

      // Render row of photos
      $markup .= <<<HTML
<div class="fliquare-row">{$row_markup}</div>
HTML;
    }

    return $markup;
  }

}

?>
