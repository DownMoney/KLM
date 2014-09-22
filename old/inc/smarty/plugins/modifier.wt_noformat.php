<?php

function smarty_modifier_wt_noformat($n, $d, $dp = '.', $t = ',') {
        return number_format($n, $d, $dp, $t);
}

?>