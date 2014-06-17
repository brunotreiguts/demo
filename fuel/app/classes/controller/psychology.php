<?php

class Controller_Psychology extends Controller_Public {

    public function action_consultations() {

        $this->template->title = __('NAV_PSYCH_CONSULTING');
        $this->template->content = View::forge('psychology/consultations'.Lang::get_lang());
    }

    public function action_diagnostics() {

        $this->template->title = __('NAV_PSYCH_DIAGNOSTICS');
        $this->template->content = View::forge('psychology/diagnostics'.Lang::get_lang());
    }

    public function action_lectures() {

        $this->template->title = __('NAV_PSYCH_LECTURES');
        $this->template->content = View::forge('psychology/lectures'.Lang::get_lang());
    }

}
