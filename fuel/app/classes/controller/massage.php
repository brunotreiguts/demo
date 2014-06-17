<?php

class Controller_Massage extends Controller_Public {

    public function action_index() {

        $this->template->title = __('NAV_MASSAGE');
            $this->template->content = View::forge('massage/index'.Lang::get_lang());
    }

}
