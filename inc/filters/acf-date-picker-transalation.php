<?php
//translation datepicket acf
$date = get_field('date_picker_field_name', false, false);
$eventDate = wp_date('M d, Y H:i:s', strtotime($date), $timezone );

?>