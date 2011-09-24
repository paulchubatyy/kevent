<?php
/**
 * Event data that is passed to event handlers
 * @author: Paul Chubatyy <xobb@citylance.biz>
 * @package KEvent
 * @category Events
 * Date: 6/26/11
 * Time: 7:39 PM 
 */
 
class Kevent_Event_Data {
    /**
     * The event data storage
     * @var array
     */
    protected $data = array();

    /**
     * Creates the event data object from array
     * @param array $params Event data
     */
    public function __construct(array $params)
    {
        $this->data = $params;
    }

    /**
     * Magic getter that retrieves data from event.
     * @throws Event_Exception
     * @param  string $key
     * @return mixed
     */
    public function __get($key)
    {
        return Arr::get($this->data, $key);
    }

	/**
	 * Magic setter, sets the data to event. May be used in event handlers to
	 * communicate
	 * @param  string $key
	 * @param  string $value
	 * @return void
	 */
	public function __set($key, $value)
	{
		$this->data[$key] = $value;
	}
}
