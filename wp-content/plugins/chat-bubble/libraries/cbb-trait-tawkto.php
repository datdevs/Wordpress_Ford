<?php
/*
*
* Trait Intro
*
*/

trait CBB_Trait_Tawkto {
	public function is_tawkto($data = array()) {
		return (@$data['enabled'] == 1 && !empty($data['tawkto']));
	}
	
	public function get_bubble_tawkto($data = array()) {
		if (!$this->is_tawkto($data)) return;
		
		require $this->get_view('chat-bubble/tawkto');
	}	
}