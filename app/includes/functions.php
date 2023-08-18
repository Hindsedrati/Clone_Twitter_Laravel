<?php
    function convertTimeToString($time)
    {
        $diff = abs(time() - strtotime($time));
        $_ = array();

        $tmp = $diff;
        $_['second'] = $tmp % 60;

        $tmp = floor( ($tmp - $_['second']) /60 );
        $_['minute'] = $tmp % 60;

        $tmp = floor( ($tmp - $_['minute'])/60 );
        $_['hour'] = $tmp % 24;

        $tmp = floor( ($tmp - $_['hour'])  /24 );
        $_['day'] = $tmp;

        if ($_['day'] > 0) {
            return $_['day'] . ' days ago';
        } elseif ($_['hour'] > 0) {
            return $_['hour'] . ' hours ago';
        } elseif ($_['minute'] > 0) {
            return $_['minute'] . ' minutes ago';
        } elseif ($_['second'] > 0) {
            return $_['second'] . ' seconds ago';
        } else {
            return 'just now';
        }
    }
?>