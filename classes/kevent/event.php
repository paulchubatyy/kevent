<?php
/**
 * Event library for dispatching and handling events
 * @author Paul Chubatyy <xobb@citylance.biz>
 * @package KEvent
 * @category Events
 */
class Kevent_Event{
	/**
	 * The stack of events and it's handlers
	 * @var array
	 */
	protected static $events = array();

	/**
	 * Dispatches the event with passing the data to the callbacks
	 * @param	string $event	Event name
	 * @param	array $data	Event data
	 * @throws	Event_Exception
	 * @return void
	 */
	public static function dispatch($event, array $data = array())
	{
        $event_params = new Event_Data($data);
		$callbacks = Arr::get(self::$events, $event, array());
		foreach ($callbacks as $callback) {
            if (!is_callable($callback)) {
				throw new Event_Exception('Event :event has invalid callback :callback',
					array(':event' => $event, ':callback' => print_r($callback, true)));
			}
			call_user_func($callback, $event_params);
		}
	}

	/**
	 * Registers the callback to the event.
	 * @param	string $event
	 * @param	callback $callback
	 * @return	void
	 */
	public static function register($event, $callback)
	{
		$callbacks = Arr::get(self::$events, $event, array());
		array_push($callbacks, $callback);
		self::$events[$event] = $callbacks;
	}

	/**
	 * Initializes the events from the configuration file.
	 */
	public static function initialize()
	{
		$data = Kohana::$config->load('events.observers');
		foreach ($data as $event => $observer) {
			if (is_callable($observer)) {
				Event::register($event, $observer);
				break;
			}
			if (!is_array($observer)) {
				throw new Event_Exception('Observer :observer is invalid',
					array(':observer' => $observer));
			}
			foreach ($observer as $obs) {
				Event::register($event, $obs);
			}
		}
	}
}