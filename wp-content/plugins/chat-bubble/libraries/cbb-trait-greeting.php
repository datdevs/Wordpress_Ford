<?php
/*
*
* Trait Greeting
*
*/

trait CBB_Trait_Greeting {
	public function is_greeting() {
		return $this->enabled_greeting == 1;
	}
	
	public function is_greeting_links() {
		return count((array) @$this->links) > 0;
	}
	
	public function is_greeting_title() {
		return $this->enabled_greeting_title == 1;
	}
	
	public function get_greeting() {
		if (!$this->is_greeting()) return;
		
		require $this->get_view('chat-bubble/greeting');
	}
	
	public function get_greeting_links() {
		if (!$this->is_greeting_links()) return array();
		
		require $this->get_view('chat-bubble/greeting-links');
	}
	
	public function get_url_blank($blank = 0) {
		return $blank == 1 ? 'target="_blank"' : '';
	}
	
	public function get_bubble_icon_title($data = array()) {
		return '<span data-bluecoral-icon-title>'.@$data['title'].'</span>';
	}
	
	public function get_bubble_icon_title_attr($data = array()) {
		return (!empty($data['title'])) ? 'data-bluecoral-icon' : '';
	}
}