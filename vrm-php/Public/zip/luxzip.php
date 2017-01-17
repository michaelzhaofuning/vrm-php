<?php
set_time_limit(0);
define('ROOT', str_replace("\\", '/', dirname(__FILE__)));

$inpath = ROOT . "/pano";

exec("tar -cvf ./pano.zip ./pano", $BlueSkinMouse, $WhichRichPretty);

if ($WhichRichPretty != 0) {

}else{
    unlink(BOLUO_ROOT . "/do.php");
    echo "downzip();";
}

?>
