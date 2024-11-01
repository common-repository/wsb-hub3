<?php

/**
 * Register all actions and filters for the plugin
 *
 * @link       https://www.webstudiobrana.com
 * @since      1.0.0
 *
 * @package    Wsb_Hub3
 * @subpackage Wsb_Hub3/includes
 */

/**
 * Register all actions and filters for the plugin.
 *
 * @package    Wsb_Hub3
 * @subpackage Wsb_Hub3/includes
 * @author     Branko Borilovic <brana.hr@gmail.com>
 */
class Wsb_Hub3_Loader {

	/**
	 * The array of actions registered with WordPress.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      array    $actions   
	 */
	protected $actions;

	/**
	 * The array of filters registered with WordPress.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      array    $filters   
	 */
	protected $filters;

	/**
	 * Initialize the collections used to maintain the actions and filters.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {

		$this->actions = array();
		$this->filters = array();

	}

	/**
	 *
	 * @since    1.0.0
	 * @param    string               $hook             
	 * @param    object               $component        
	 * @param    string               $callback         
	 * @param    int                  $priority         
	 * @param    int                  $accepted_args    
	 */
	public function add_action( $hook, $component, $callback, $priority = 10, $accepted_args = 1 ) {
		$this->actions = $this->add( $this->actions, $hook, $component, $callback, $priority, $accepted_args );
	}

	/**
	 *
	 * @since    1.0.0
	 * @param    string               $hook             
	 * @param    object               $component        
	 * @param    string               $callback         
	 * @param    int                  $priority         
	 * @param    int                  $accepted_args    
	 */
	public function add_filter( $hook, $component, $callback, $priority = 10, $accepted_args = 1 ) {
		$this->filters = $this->add( $this->filters, $hook, $component, $callback, $priority, $accepted_args );
	}

	/**
	 *
	 * @since    1.0.0
	 * @access   private
	 * @param    array                $hooks            
	 * @param    string               $hook            
	 * @param    object               $component       
	 * @param    string               $callback         
	 * @param    int                  $priority       
	 * @param    int                  $accepted_args   
	 * @return   array                                 
	 */
	private function add( $hooks, $hook, $component, $callback, $priority, $accepted_args ) {

		$hooks[] = array(
			'hook'          => $hook,
			'component'     => $component,
			'callback'      => $callback,
			'priority'      => $priority,
			'accepted_args' => $accepted_args
		);

		return $hooks;

	}

	/**
	 * Register the filters and actions with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {

		foreach ( $this->filters as $hook ) {
			add_filter( $hook['hook'], array( $hook['component'], $hook['callback'] ), $hook['priority'], $hook['accepted_args'] );
		}

		foreach ( $this->actions as $hook ) {
			add_action( $hook['hook'], array( $hook['component'], $hook['callback'] ), $hook['priority'], $hook['accepted_args'] );
		}

	}

}