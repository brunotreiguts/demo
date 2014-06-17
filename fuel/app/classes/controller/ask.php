<?php

class Controller_Ask extends Controller_Public {

    public function action_index() {
        $view = View::forge('ask/index');
        
        $val = Validation::forge();
        
        if (Input::method() == 'POST') {

            $val->add('name', __('ASK_VAL_ERROR_NAME'))
                    ->add_rule('required')
                    ->add_rule('max_length', '255')
                    ->add_rule('min_length', '3')
                    ->add('email', __('ASK_VAL_ERROR_EMAIL'))
                    ->add_rule('required')
                    ->add_rule('max_length', '255')
                    ->add_rule('valid_email')
                    ->add('message', __('ASK_VAL_ERROR_MESSAGE'))
                    ->add_rule('required')
                    ->add_rule('min_length', '3');

            $val->set_message('min_length', 'You have to fill your :label with at least 3 characters');
            $val->set_message('max_length', 'The field  :label maximum length is 255 characters');
            $val->set_message('valid_email', 'The field  :label does not contain a valid e-mail adress');
            
            if ($val->run()) {

                try {
                    Email::forge()
                            ->to('bruno.treiguts@gmail.com')
                            ->from(Input::post('name') . Input::post('name'))
                            ->subject('Jauns jautājums no Laimas.lv')
                            ->body('E-pastu nosūtīja:  ' . Input::post('name') . '   ' . Input::post('email') . "\r\nSaturs:\r\n" . Input::post('message'))
                            ->send();
                    Session::set_flash('success', __('QUESTION_HAS_BEEN_SENT'));
                    Response::redirect('ask/index');
                } catch (EmailSendingFailedException $e) {

                    $view->error = __('ASK_ERROR_WHILE_SENDING');
                }
            } 
        }
        $view->val = $val;
        $this->template->title = __('ASK_HEADING');
        $this->template->content = $view;
    }

    public function action_sent() {
        $this->template->title = __('QUESTION_HAS_BEEN_SENT_SENT');
        $this->template->content = View::forge('ask/index');
    }

}
