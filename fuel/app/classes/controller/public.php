<?php

class Controller_Public extends Controller_Template
{
    public function before()
    {   

        parent::before();
        
        if (Auth::check())
        {
            list($driver, $user_id) = Auth::get_user_id();
            $this->current_user = Model_User::find($user_id);
        }
        else
        {
            $this->current_user = null;
        }
        
        View::set_global('current_user', $this->current_user);
        
        $current_lang = Session::get('lang');
        Config::set('language', $current_lang);
        Lang::load('main');
        }
        
public function action_lang($lang=null){
	if ($lang!=null){
            
        if($lang == 'lv'){
            $lang_name = __('LATVIAN');
                        
        }elseif($lang == 'en'){
            $lang_name = __('ENGLISH');
        }else{
            $lang = 'lv';
            $lang_name = __('LATVIAN');
        }
            
	    Session::set('lang', $lang);
	    Response::redirect("/");
	}

    }
    
        
}
