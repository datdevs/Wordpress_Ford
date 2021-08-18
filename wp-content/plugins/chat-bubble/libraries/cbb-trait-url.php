<?php
/*
*
* Trait URL
*
*/

trait CBB_Trait_Url {		
	public function get_bubble_phone($data = array()) {
		if ((int) @$data['enabled'] == 0) return;
		
		require $this->get_view('chat-bubble/phone');
	}
	
	public function get_telto($phone = '') {
		return esc_attr('tel:'.$phone);
	}
	
	public function get_bubble_email($data = array()) {
		if ((int) @$data['enabled'] == 0) return;
		
		require $this->get_view('chat-bubble/email');
	}
	
	public function get_mailto($email = '') {
		return esc_attr('mailto:'.$email);
	}
	
	public function get_bubble_url($data = array()) {
		if ((int) @$data['enabled'] == 0) return;
		
		require $this->get_view('chat-bubble/url');
	}
	
	public function get_bubble_messenger($data = array()) {
		if ((int) @$data['enabled'] == 0) return;
		
		require $this->get_view('chat-bubble/messenger');
	}
	
	public function get_url_messenger($id = '') {
		return esc_url('https://m.me/'.$id);
	}
	
	public function get_bubble_telegram($data = array()) {
		if ((int) @$data['enabled'] == 0) return;
		
		require $this->get_view('chat-bubble/telegram');
	}
	
	public function get_url_telegram($id = '') {
		return esc_url('https://t.me/'.$id);
	}
	
	public function get_bubble_line($data = array()) {
		if ((int) @$data['enabled'] == 0) return;
		
		require $this->get_view('chat-bubble/line');
	}
	
	public function get_url_line($id = '') {
		return esc_url('https://line.me/R/ti/p/@'.$id);
	}
	
	public function get_bubble_skype($data = array()) {
		if ((int) @$data['enabled'] == 0) return;
		
		require $this->get_view('chat-bubble/skype');
	}
	
	public function get_url_skype($id = '') {
		return esc_url('https://msng.link/o/?'.$id.'=sk');
	}
	
	public function get_bubble_viber($data = array()) {
		if ((int) @$data['enabled'] == 0) return;
		
		require $this->get_view('chat-bubble/viber');
	}
	
	public function get_url_viber($id = '') {
		return esc_url('https://viber.me/'.$id);
	}
	
	public function get_bubble_whatsapp($data = array()) {
		if ((int) @$data['enabled'] == 0) return;
		
		require $this->get_view('chat-bubble/whatsapp');
	}
	
	public function get_url_whatsapp($id = '') {
		return esc_url('https://api.whatsapp.com/send?phone='.$id);
	}
	
	public function get_bubble_zalo($data = array()) {
		if ((int) @$data['enabled'] == 0) return;
		
		require $this->get_view('chat-bubble/zalo');
	}
	
	public function get_url_zalo($id = '') {
		return esc_url('https://zalo.me/'.$id);
	}	
}