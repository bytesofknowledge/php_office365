<?php

// Office365 singleton
require(dirname(__FILE__) . '/Office365.php');

// Utilities
require(dirname(__FILE__) . '/HttpPost.php');

// Plumbing
require(dirname(__FILE__) . '/ApiResource.php');
require(dirname(__FILE__) . '/Assertion.php');
require(dirname(__FILE__) . '/AccessToken.php');

// API Resources
require(dirname(__FILE__) . '/Authorize.php');
require(dirname(__FILE__) . '/Mail.php');
require(dirname(__FILE__) . '/Calendar.php');

// Composer Libraries
require 'vendor/autoload.php';
