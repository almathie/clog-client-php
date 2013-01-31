<?php

require_once('ClogCore.class.php'); 

class ClogLogMessage{
	protected $message;
	protected $tags = array();

	function __construct($message, $tags = array()){
		$this->message = (string) $message;
		$this->tags = $tags;
	}

	function setTags($tags = array()) {
    	foreach($tags as $tag_name => $tag_value){
    		$this->setTag($tag_name, $tag_value);
    	}
    }

	function setTag($tag_name, $tag_value){
		$this->tags[$tag_name] = $tag_value;
	}

	function getTag($tag_name){
		return $this->tags[$tag_name];
	}

	function asArray(){
		$array = array();
		$array['message'] = $this->message;
		$array['tags'] = $this->tags;
		return $array;
	}
}

class ClogLogger extends ClogCore {
	protected $client_version = '0.0.1';
    protected $client_name    = 'clog_logger_php';
    protected $api_version    = '1.0';
    protected $default_values = array(
        'protocol'    => 'http',
        'host'        => 'localhost',
        'port'        => '80',
    );

    protected $tags = array();

    /**
     * @param string|array $config_file_or_options
     *        Array of options or name of config file.
     * Fields in options array or in config:
     *
     * Required:
     * - token
     * - project_id
     * Optional:
     * - protocol
     * - host
     * - port
     */
    function __construct($config_file_or_options = null){
        $this->getConfigData($config_file_or_options);
    }

    function setTags($tags = array()) {
    	foreach($tags as $tag_name => $tag_value){
    		$this->setTag($tag_name, $tag_value);
    	}
    }

    function setTag($tag_name, $tag_value){
		$this->tags[$tag_name] = $tag_value;
	}

	function getTag($tag_name){
		return $this->tags[$tag_name];
	}

	function log($message, $tags = array()){
		$log_msg = new ClogLogMessage($message, $this->tags);
		$log_msg->setTags($tags);
		$params = $log_msg->asArray();
		$url = "/projects/{$this->project_id}/logs";
		$response = $this->apiCall(self::POST, $url, $params);
		return self::json_decode($response);
	}
}