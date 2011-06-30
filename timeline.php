<?php

require('/home/content/53/8018853/html/lib/template.php');

$body = <<<HTML

<div id="doc" class="yui-t4">

  <div id="timeline">
    <div class="school">
      <a href="http://www.rishworth-school.co.uk/default.shtml"><img src="http://bendalziel.com/assets/images/rishworth.png" title="Rishworth School Crest" alt="Rishworth School Crest" /></a>
      <h2>Rishworth School</h2>
      <h3>West Yorkshire, England</h3>
    </div>
    <div class="school">
      <a href="http://www.dur.ac.uk/"><img src="http://bendalziel.com/assets/images/durham.png" title="Durham University Crest" alt="Durham University Crest" /></a>
      <h2>Durham University</h2>
      <h3>Durham, England</h3>
    </div>
    <div class="school">
      <a href="http://www.sfsu.edu/"><img src="http://bendalziel.com/assets/images/sfstate.png" title="San Francisco State University Crest" alt="San Francisco State University Logo" /></a>
      <h2>SF State University</h2>
      <h3>San Francisco, California USA</h3>
    </div>
    <div class="school">
      <a href="http://sports.yahoo.com/"><img src="http://bendalziel.com/assets/images/yahoo.png" title="Yahoo! Logo" alt="Yahoo! Logo" /></a>
      <h2>Yahoo!</h2>
      <h3>Sunnyvale, California USA</h3>
    </div>
  </div>

</div>

HTML;

$assembled_page = assemble_page($body);

print $assembled_page;

?>

