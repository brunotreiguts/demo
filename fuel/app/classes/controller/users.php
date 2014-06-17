<?php

class Controller_Users extends Controller_Public {

    public function action_change($id) {
        $user = Model_User::find($id);
                
        if (Input::method() == 'POST') {
            $val = Validation::instance();
            $val->add('oldpassword', 'Vecā parole')
                    ->add_rule('required');
            $val->add('newpassword', 'Jaunā parole')
                    ->add_rule('required')
                    ->add_rule('min_length', 3)
                    ->add_rule('max_length', 10);

            if ($val->run()) {
                try {
                    if (Auth::instance()->change_password(Input::post('oldpassword'), Input::post('newpassword'),$user->username)) {
                        Session::set_flash("success", "Parole nomainīta.");
                    } else {
                        Session::set_flash("error", "Parole netika nomainīta.");
                    }
                }
                catch (SimpleUserUpdateException $e) {
                    $this->template->set_global('change_password_error', $e->getMessage());
                }
            }
        }else{

        }

        $this->template->title = 'Lietotāju saraksts';
        $this->template->content = View::forge('users/change');
    }

    public function action_list() {
        $data['users'] = Model_User::find('all');
        $this->template->title = 'Lietotāju saraksts';
        $this->template->content = View::forge('users/list', $data);
    }

    public function action_create() {
        if (Auth::has_access('users.create')) {
            if (Input::method() == "POST") {
                $exist_user = DB::select("id")
                        ->from("users")
                        ->where("username", "=", Input::post("username"))
                        ->execute()
                        ->as_array();
                $is_err = false;
                if (count($exist_user) > 0) {
//sorry, the username is taken already :(
                    Session::set_flash("error", "Šāds lietotāvrds jau eksistē");
                    $is_err = true;
                }
                if (Input::post("password") != Input::post("repeat_password")) {
                    Session::set_flash("error", "Paroles nesakrīt.");
                    $is_err = true;
                }

                if ($is_err == false) {
                    Auth::instance()->create_user(
                            Input::post("username"), //username = email
                            Input::post("password"), Input::post("email"), Input::post("group"));
                    Session::set_flash("success", "Lietotājs pievienots.");
                    Response::redirect("/");
                }
            }
            $this->template->title = "Become a member";
            $this->template->content = View::forge("users/create");
        } else {
            Response::redirect('404');
        }
    }

    public function action_login() {
        if (Input::method() == 'POST') {
            if (Auth::login(Input::post('username'), Input::post('password'))) {
                Session::set_flash('success', 'Jūs esat veiksmīgi pierakstījies sistēmā!');
                Response::redirect('users/panel');
            } else {

                Session::set_flash('error', 'Nepareizi pieejas dati!');
                Response::redirect_back('users/login');
//  exit('Nepareizi pieejas dati!');
            }
        }
        $this->template->title = 'Pierakstīšanās sistēmā';
        $this->template->content = View::forge('users/login');
    }

    public function action_logout() {
        Auth::logout();
        Session::set_flash('success', 'Jūs veiksmīgi izrakstījāties no sistēmas');
        Response::redirect('welcome');
    }

    public function action_delete($id) {

        $user = Model_User::find($id);

        Auth::delete_user($user->username);

        Session::set_flash('success', 'Jūs veiksmīgi izrakstījāties no sistēmas');
        Response::redirect('users/list');
    }

}
