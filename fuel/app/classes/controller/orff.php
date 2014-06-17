<?php

class Controller_Orff extends Controller_Public {

    public function action_index() {

        $this->template->title = __('NAV_ORFF');
        $this->template->content = View::forge('orff/index'.Lang::get_lang());
    }
    
}
