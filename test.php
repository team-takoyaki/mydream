<?php
require_once('lib/helper.php');
$text = <<<HTML
Hellooooooo
http://google.co.jp
http://yahoo.co.jp
HTML;
echo set_linked_from_text($text);
