<?php
$date = date('Y-m-d');
$datetime1 = new DateTime('2020-06-18');
$datetime2 = new DateTime('2009-10-13');
$interval = $datetime1->diff($datetime2);
echo $interval->format('%R%a days');
echo $date;
?>
