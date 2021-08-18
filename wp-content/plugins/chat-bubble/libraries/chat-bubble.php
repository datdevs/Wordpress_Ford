<?php
/*
*
* View Name: Chat Bubble class
*
*/

if (!defined('ABSPATH')) exit; 


if (!class_exists('CBB_Msg')) {
	class CBB_Msg {		
		use CBB_Trait_Greeting;
		use CBB_Trait_Intro;
		use CBB_Trait_Callback;
		use CBB_Trait_Url;
		use CBB_Trait_Tawkto;
		
		/**
		* Class Construct
		*/
		public function __construct($args = array()) {
			if (count($args) > 0) {
				foreach ($args as $i => $v) {
					$this->$i = $this->format_value($i, $v);
				}
			}
			
			$this->retrieve_fields();
		}
		
		public function __get($attr = ''){
			return isset($this->$attr) ? $this->$attr : '';
		}
		
		function format_value($key = '', $value) {
			if (is_int($value)) return $value;
			if (is_array($value)) return $value;

			return stripcslashes($value);
		}
		
		function get_view($view = '') {
			$filter = 'get_'.str_replace('-', '_', sanitize_title($view));  
			
			$file = apply_filters($filter, trailingslashit(plugin_dir_path(__FILE__)).'../views/'.$view.'.php', $view);
			
			if (file_exists($file)) return $file;
		}
		
		
		/**
		* Theme
		*/		
		public function get_theme_styles() {
			require $this->get_view('chat-bubble/theme');
		}
		
		
		/**
		* Bubble section
		*/		
		public function retrieve_fields() {
			$data = CBB_Fields::retrieve_fields($this, false);
			$this->inner = (isset($data['inner'])) ? (array) $data['inner'] : array();
			$this->outer = (isset($data['outer'])) ? (array) $data['outer'] : array();
			$this->fields = (isset($data['fields'])) ? (array) $data['fields'] : array();
			$this->inner_fields = (isset($data['inner_fields'])) ? (array) $data['inner_fields'] : array();
			$this->outer_fields = (isset($data['outer_fields'])) ? (array) $data['outer_fields'] : array();
		}
		
		public function get_bubble_list($position = '', $class = '') {
			if (!isset($this->$position)) return;
			
			$this->bubble_list_pos = $position;
			$this->bubble_list_class = $class;
			$this->bubble_list_fields = $this->$position;
			
			if (count($this->bubble_list_fields) > 0) require $this->get_view('chat-bubble/list');
		}
	}
}