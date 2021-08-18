<?php
/*
*
* Trait Callback modal
*
*/

trait CBB_Trait_Callback {		
	public function get_bubble_callback_simple($data = array()) {
		if ((int) @$data['enabled'] == 0) return;
		
		require $this->get_view('chat-bubble/callback-simple');
	}
	
	public function get_bubble_callback_advanced($data = array()) {
		if ((int) @$data['enabled'] == 0) return;
		
		require $this->get_view('chat-bubble/callback-advanced');
	}
	
	public function get_callback_modal() {
		if (@$this->callback_simple['enabled'] == 1) require $this->get_view('chat-bubble/modal-callback-simple');
			
		if (@$this->callback_advanced['enabled'] == 1) require $this->get_view('chat-bubble/modal-callback-advanced');
		
		require $this->get_view('chat-bubble/modal-callback-end');
	}	
}