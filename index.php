<?php

require('/home/content/53/8018853/html/lib/template.php');

$img_src = '';
$img_title = '';
$img_url = '';

$img_src = 'http://farm4.static.flickr.com/3380/3520641583_1faa2d7ed0_b.jpg';
$img_title = 'Cow standing in a field by Ben Dalziel on Flickr';
$img_url = 'http://www.flickr.com/photos/bendalziel/3520641583/in/photostream/';

$img_markup = <<<HTML
<img src="{$img_src}" title="{$img_title}" alt="{$img_title}" />
HTML;

$linked_img_markup = $img_markup;

if ($img_url)
{
  $linked_img_markup = <<<HTML
<a href="{$img_url}">{$img_markup}</a>
HTML;
}

$body = <<<HTML

<div id="doc" class="yui-t4">

  <div class="card-image v-top">
    {$img_markup}
  </div>

  <div class="card-image v-middle-left">
    {$img_markup}
  </div>

  <div id="card-container">
    <div id="card">
      <h1>Ben Dalziel</h1>
      <h2>- Home -</h2>
<!--
      <h2><a href="http://sports.yahoo.com" title="Ben Dalziel is a senior software engineer currently working for Yahoo! Sports">Senior Software Engineer</a></h2>
-->
    </div>
  </div>

  <div class="card-image v-middle-right">
    {$linked_img_markup}
  </div>

  <div class="card-image v-bottom">
    {$img_markup}
  </div>

</div>

HTML;

$assembled_page = assemble_page($body);

print $assembled_page;

?>
