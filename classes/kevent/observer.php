<?php
/**
 * Observer base class.
 * @author Paul Chubatyy <xobb@citylance.biz>
 * @package KEvents
 * @category Events
 */
class Kevent_Observer {
	/**
	 * Observer instances stack
	 * @var array
	 */
	protected static $observers = array();

	/**
	 * Singleton for observer objects
	 * @param string $entity Observer name
	 * @return	object	Observer
	 */
	public static function instance($entity)
	{
		$observer = Arr::get(self::$observers, $entity);
		if (is_null($observer)) {
			$observer = self::factory($entity);
			array_push(self::$observers, $observer);
		}
		return $observer;
	}

	/**
	 * Protected factory method that instantiates observer
	 * @param string $entity entity name observer
	 * @return object Observer
	 */
	protected static function factory($entity)
	{
		$class_name = 'Observer_'.$entity;
		return new $class_name;
	}

	/**
	 * Validates the model
	 * @param Event_Data $data
	 * @return void
	 */
	public function validate(Event_Data $data)
	{
		$data->object->validate();
	}

	/**
	 * Sets the created at field for the object.
	 * @param Event_Data $data
	 * @return void
	 */
	public function set_created_timestamp(Event_Data $data)
	{
		$data->object->created_at = time();
	}

	/**
	 * Sets the updated at field for the object.
	 * @param Event_Data $data
	 * @return void
	 */
	public function set_updated_timestamp(Event_Data $data)
	{
		$data->object->updated_at = time();
	}
}