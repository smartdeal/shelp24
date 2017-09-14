<?php 

require_once("../../../wp-load.php"); 
require_once("simple_html_dom.php"); 

$out = '';
$cur_link = $_GET["link"];
if ($cur_link) {
    // $out .= $cur_link.'<br>';
    $html = file_get_html($cur_link);
    $content = $html->find('#js-content', 0)->innertext;
    if ($content) $out .= $content;
}

echo $out;

?>
