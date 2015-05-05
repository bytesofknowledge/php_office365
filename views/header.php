<?php
/**
 * Header
 */

if ( isset($_SESSION['access_token']) && $_SERVER['REQUEST_URI'] !== '/' ) {
	echo "<a href='/mail'>Email</a>";
	echo " | ";
	echo "<a href='/calendar'>Calender</a>";
	echo " | ";
	echo "<a href='/'>Reset Access Token</a>";
} else {
	$forward_url = \Office365\Authorize::retrieve();
	echo "<a class='login' href='$forward_url'>Connect Me!</a>";
}