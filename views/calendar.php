<?php
/**
 * Display Calendar Response Data
 */

echo '<table width="100%" border="1">';
echo '<tr>';
echo '<th>Subject</th>';
echo '<th>Date</th>';
echo '<th>Start</th>';
echo '<th>End</th>';
echo '</td>';

foreach ( $response->value as $event ) {
    $startDate = new DateTime($event->Start);
    $endDate = new DateTime($event->End);

    echo '<tr>';
    echo '<td>' . $event->Subject . '</td>';
    echo '<td>' . $startDate->format('M j, Y') . '</td>';
    echo '<td>' . $startDate->format('g:i a') . '</td>';
    echo '<td>' . $endDate->format('g:i a') . '</td>';
    echo '</tr>';
}

echo '</table>';