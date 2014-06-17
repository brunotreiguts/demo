<?php

class Controller_Montessori extends Controller_Public {

    public function action_about() {

        $this->template->title = __('NAV_MON_ABOUT');
        $this->template->content = View::forge('montessori/about'.Lang::get_lang());
    }

    public function action_lessons() {

        $this->template->title = __('NAV_MON_ACTIVITIES');
        $this->template->content = View::forge('montessori/lessons'.Lang::get_lang());
    }

    public function action_therapy() {

        $this->template->title = __('NAV_MON_THERAPY');
        $this->template->content = View::forge('montessori/therapy'.Lang::get_lang());
    }

}
