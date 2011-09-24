KEvents Library
===============

Presenting events and observers for you. Config based.
You set your events in the configuration file. Thanks to Kohana 3.2 the configuration is collected frim the all modules.
Example usage:

	Event::dispatch('event_name', array('entity' => $something');
	
The observers will handle that event.
