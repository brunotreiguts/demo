<?php

class Controller_Sand extends Controller_Public {

    public function action_index() {

        $this->template->title = __('NAV_SAND');
        $this->template->content = View::forge('sand/index'.Lang::get_lang());
    }
    
}
