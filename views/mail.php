<?php
/**
 * Display Mail Response Data
 */

echo '<table width="100%" border="1">';
echo '<tr>';
echo '<th>Date</th>';
echo '<th>From</th>';
echo '<th>Subject</th>';
echo '</td>';

foreach ( $response->value as $mail ) {
	$date = new DateTime($mail->DateTimeReceived);
	
	echo '<tr>';
	echo '<td>' . $date->format('Y-m-d H:i:s') . '</td>';
	echo '<td>' . $mail->From->EmailAddress->Name . '</td>';
	echo '<td>' . $mail->Subject . '</td>';
	echo '</tr>';
}

echo '</table>';