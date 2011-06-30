<?php

require('lib/template.php');

$body = <<<HTML

<div id="doc" class="yui-t4">

  <div class="card-image v-top">
  </div>

  <div class="card-image v-middle-left">
  </div>
  <div id="card-container">
    <div id="card">
      <h1>WTF?!</h1>
      <h2><a href="http://bendalziel.com" title="Get me out of here!">"Take me home"</a></h2>
      <p style="text-align: center;">or</p>
      <h2><a href="http://www.flickr.com/explore/interesting/7days/" title="I'm going to look at some random photos...">"Screw it, you had your chance..."</a></h2>
    </div>
  </div>
  <div class="card-image v-middle-right">
  </div>

  <div class="card-image v-bottom">
  </div>


</div>

HTML;

$assembled_page = assemble_page($body);

print $assembled_page;

?>

