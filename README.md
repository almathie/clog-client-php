# clog-client-php

clog-client-php is a PHP client for the [Clog](https://github.com/almathie/clog) logging platform.

Tags can be defined at the message or at the logger level for additional flexibility.

## Installation and usage

See the file `example/basic_example.php` for a simple introduction.

### Include the logger
```php
<?php
require_once('lib/ClogLogger.php');
```

## Configure

```php
$logger = new \Clog\ClogLogger(array(
	'host' => 'clog.your-site.com',
	'port' => '443',
	'protocol' => 'https',
    'token' => 'XXXXXXXXX',
    'project_id' => 'XXXXXXXXX'
));
```
See clog documentation to get your token. The project_id is the name of your project.


## Use

### Log a message
Without tags :

```php
$logger->log("This is a log message");
```

With tags attached :

```php
$logger->log("This is another log message", array(
	'log-message-tag-1' => 'log message tag value 1', 
	'other-message-tag' => 'other value'
));
```

Tags attached to the log message override tags set at the logger level, and tags set at the project level (see clog documentation). 

### Set Tags at the logger level
```php
$logger->setTags(array("logger-tag-1" => "logger value 1", "logger-tag-2" => "logger_value_2"));
$logger->setTag("logger-tag-3", "logger value 3");
```
Any subsequent log message sent to that logger will have those tags by default.

Tags set at the logger level override tags set at the project level, but can be overriden by tags associated with the individual messages.

## Acknowledgement

The `ClogCore.class.php` is a minor adaptation (aka: a rip-off) of `IronCore.class.php` which can be found [here](https://github.com/iron-io/iron_core_php). The guys from [Iron.io](http://iron.io) deserve all the kudos for creating this neat little lib. If you happen to be one of them : THANK YOU.

## License

This software is released under the BSD 2-Clause License. You can find the full text of
this license under LICENSE.txt in the module's root directory.