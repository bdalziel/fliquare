<?php

function assemble_page ($body, $title = 'Home') {

  $google_code = <<<JS
<script type="text/javascript">

    var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-2650047-8']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
JS;

  return <<<HTML

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd"> 
<html> 
 
<head> 

    <title>{$title} | Ben Dalziel</title>
  <meta http-equiv="content-type" content="text/html; charset=utf-8">
  <meta name="description" content="The virtual home of Ben Dalziel">
  <meta name="keywords" content="Ben Dalziel, Benjamin Dalziel, Benjamin John Dalziel, Yahoo!, San Francisco, Yahoo! Sports, Resume, Profile">

  <link rel="shortcut icon" href="http://bendalziel.com/favicon.ico" />
  <link rel="icon" href="http://bendalziel.com/favicon.ico" />

  <link rel="image_src" href="http://bendalziel.com/assets/images/bdalziel.png" /> 

  <!-- JS -->
  <script type="text/javascript" src="http://yui.yahooapis.com/combo?3.3.0/build/yui/yui-min.js"></script>

  <!-- CSS -->
  <link rel="stylesheet" type="text/css" media="screen" href="http://bendalziel.com/assets/css/main.css" /> 

  {$google_code}
</head>

<body>
  {$body}

  <div id="footer">
      <ul class="profile-links">
        <li class="first">&copy; Ben Dalziel 2011</li>
        <li><a href="http://www.linkedin.com/in/bendalziel" title="Ben Dalziel's professional profile on LinkedIn">Profile</a></li>
        <li><a href="http://www.flickr.com/photos/bendalziel/" title="Ben Dalziel's photography on Flickr">Camera Roll</a></li>
        <li>
<!--
          <a href="http://twitter.com/bdalziel" class="twitter-follow-button" data-show-count="false" data-button="grey" data-text-color="#CCCCCC" data-link-color="#999999">Follow @bdalziel</a>
          <script src="http://platform.twitter.com/widgets.js" type="text/javascript"></script>
-->
          <a href="https://twitter.com/#!/bdalziel" title="Ben Dalziel on Twitter">@bdalziel</a>
        </li>
      </ul>
  </div>

</body>

</html>
HTML;
}

?>
