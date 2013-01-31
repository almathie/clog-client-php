<?php
require_once(dirname(__FILE__) . '/../lib/ClogLogger.class.php'); 

$logger = new \Clog\ClogLogger(array(
	'host' => "127.0.0.1",
	'port' => "9292",
	'token' => "YETBHmDM13vQTtN=1pcnS8vNpPW",
	'project_id' => 'example-project'
));

$logger->log("log message without tags");

$logger->setTags(array("logger-tag-1" => "logger value 1", "logger-tag-2" => "logger_value_2"));

$logger->log("log message with logger tags");

$logger->log("log message with logger and custom tags", array("message-tag" => "message-value", "logger-tag-2" => "overrid-value"));
