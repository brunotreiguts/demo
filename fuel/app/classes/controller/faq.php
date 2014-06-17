<?php

class Controller_Faq extends Controller_Public {

    public function action_index() {
        $data['faqs'] = Model_Faq::find('all');
        $this->template->title = __('FAQ_HEADING');
        $this->template->content = View::forge('faq/index', $data);
        
    }
    
    public function action_create() {
        if (Auth::has_access('faq.create')) {
            if (Input::method() == 'POST') {
                $val = Model_Faq::validate('create');

                if ($val->run()) {
                    $faq = Model_Faq::forge(array(
                                'question' => Input::post('question'),
                                'answer' => Input::post('answer'),
                    ));

                    if ($faq and $faq->save()) {
                        Session::set_flash('success', __('FAQ_ADDED_NEW_WITH_NR') . $faq->id . '.');

                        Response::redirect('faq');
                    } else {
                        Session::set_flash('error', __('FAQ_COULD_NOT_SAVE'));
                    }
                } else {
                    Session::set_flash('error', $val->error());
                }
            }

            $this->template->title = __('FAQ_HEADING');
            $this->template->content = View::forge('faq/create');
        } else {
            Response::redirect('404');
        }
    }

    public function action_edit($id = null) {
        if (Auth::has_access('faq.manage')) {
            is_null($id) and Response::redirect('faq');

            if (!$faq = Model_Faq::find($id)) {
                Session::set_flash('error', __('FAQ_COULD_NOT_FIND_WITH_NR') . $id);
                Response::redirect('faq');
            }

            $val = Model_Faq::validate('edit');

            if ($val->run()) {
                $faq->question = Input::post('question');
                $faq->answer = Input::post('answer');

                if ($faq->save()) {
                    Session::set_flash('success', __('FAQ_EDITED_WITH_NR'));

                    Response::redirect('faq');
                } else {
                    Session::set_flash('error', __('FAQ_COULD_NOT_EDIT_WITH_NR') . $id);
                }
            } else {
                if (Input::method() == 'POST') {
                    $faq->question = $val->validated('question');
                    $faq->answer = $val->validated('answer');

                    Session::set_flash('error', $val->error());
                }

                $this->template->set_global('faq', $faq, false);
            }

            $this->template->title = __('FAQ_HEADING');
            $this->template->content = View::forge('faq/edit');
        } else {
            Response::redirect('404');
        }
    }

    public function action_delete($id = null) {
        if (Auth::has_access('faq.manage')) {
            is_null($id) and Response::redirect('faq');

            if ($faq = Model_Faq::find($id)) {
                $faq->delete();

                Session::set_flash('success', __('FAQ_DELETED_WITH_NR'));
            } else {
                Session::set_flash('error', __('FAQ_COULD_NOT_DELETE_WITH_NR') . $id);
            }

            Response::redirect('faq');
        } else {
            Response::redirect('faq');
        }
    }
    
    
    

}
