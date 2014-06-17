<?php

class Controller_Contact extends Controller_Public {

    public function action_index() {

        $this->template->title = __('NAV_CONTACT');
        $this->template->content = View::forge('contact/index'.Lang::get_lang());
    }
    
}
