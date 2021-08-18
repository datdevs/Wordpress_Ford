<?php
/*
*
* Trait Intro
*
*/

trait CBB_Trait_Intro {
	public function is_intro() {
		return $this->enabled_intro == 1 && !empty($this->intro);
	}
	
	public function get_intro() {
		if (!$this->is_intro()) return;
		
		require $this->get_view('chat-bubble/intro');
	}	
}