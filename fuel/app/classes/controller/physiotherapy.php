<?php

class Controller_Physiotherapy extends Controller_Public {

    public function action_index() {

        $this->template->title = __('NAV_PHYSIOTHERAPY');
        $this->template->content = View::forge('physiotherapy/index'.Lang::get_lang());
    }
    
}
