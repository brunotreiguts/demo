<?php

class Controller_Material extends Controller_Public {

    public function action_index() {
        $data['materials'] = Model_Material::find('all');
        $this->template->title = __('MATERIAL_HEADER');
        $this->template->content = View::forge('material/index', $data);
    }

    public function action_create() {
        if (Auth::has_access('material.create')) {
        if (Input::method() == 'POST') {
            $val = Model_Material::validate('create');

            if ($val->run()) {
                $config = array(
                    'path' => DOCROOT . DS . 'assets/img/materials/',
                    'randomize' => true,
                    'ext_whitelist' => array('img', 'jpg', 'jpeg', 'gif', 'png'),
                );

                Upload::process($config);

                if (Upload::is_valid()) {

                    Upload::save();

                    $filename = Upload::get_files()[0]['saved_as'];

                    Session::set_flash('success', __('EMPLOYEE_IMAGE_UPLOAD_SUCCESS'));
                } else {
                    Session::set_flash('error', __('EMPLOYEE_IMAGE_NOT_VALID'));
                    Response::redirect('material/create');
                }


                $material = Model_Material::forge(array(
                            'image' => $filename,
                            'title' => Input::post('title'),
                            'description' => Input::post('description'),
                            'price' => Input::post('price'),
                ));

                if ($material and $material->save()) {
                    Session::set_flash('success', __('MATERIAL_ADDED_SUCCESS') . $material->id . '.');

                    Response::redirect('material');
                } else {
                    Session::set_flash('error', __('MATERIAL_ADDED_FAILURE'));
                }
            } else {
                Session::set_flash('error', $val->error());
            }
        }

        $this->template->title = __('MATERIAL_HEADER');
        $this->template->content = View::forge('material/create');
    }else {
            Response::redirect('404');
        }
    }

    public function action_edit($id = null) {
         if (Auth::has_access('material.manage')) {
        is_null($id) and Response::redirect('material');

        if (!$material = Model_Material::find($id)) {
            Session::set_flash('error', __('MATERIAL_COULD_NOT_FIND') . $id);
            Response::redirect('material');
        }

        $val = Model_Material::validate('edit');

        if ($val->run()) {
            
            $upload = Input::post('upload');

            if ($upload == '1') {
                
                $material->title = Input::post('title');
                $material->description = Input::post('description');
                $material->price = Input::post('price');
                
            } else {


                    $config = array(
                        'path' => DOCROOT . DS . 'assets/img/materials/',
                        'randomize' => true,
                        'ext_whitelist' => array('img', 'jpg', 'jpeg', 'gif', 'png'),
                    );

                    $filename = null;

                    Upload::process($config);
                    if (Upload::is_valid()) {

                        $oldfile = $material->image;

                        Upload::save();

                        $filename = Upload::get_files()[0]['saved_as'];

                        File::delete(DOCROOT . 'assets/img/materials/' . $oldfile);
                        Session::set_flash('success', __('MATERIAL_IMAGE_UPLOAD_SUCCESS'));
                    } else {
                        Session::set_flash('error', __('MATERIAL_IMAGE_NOT_VALID'));
                        Response::redirect('material/edit/' . $id);
                    }

                    $material->title = Input::post('title');
                    $material->description = Input::post('description');
                    $material->price = Input::post('price');

                    if ($filename != null) {
                        $material->image = $filename;
                    } else {
                        $material->image  = Input::post('image');
                        Session::set_flash('error', __('MATERIAL_IMAGE_UPLOAD_FAILURE'));
                    }
            }
            if ($material->save()) {
                Session::set_flash('success', __('MATERIAL_UPDATE_SUCCESS') . $id);

                Response::redirect('material');
            } else {
                Session::set_flash('error', __('MATERIAL_UPDATE_FAILURE_SUCCESS') . $id);
            }
        } else {
            if (Input::method() == 'POST') {
                $material->image = $val->validated('image');
                $material->title = $val->validated('title');
                $material->description = $val->validated('description');
                $material->price = $val->validated('price');

                Session::set_flash('error', $val->error());
            }

            $this->template->set_global('material', $material, false);
        }

        $this->template->title = __('MATERIAL_HEADER');
        $this->template->content = View::forge('material/edit');
    }else {
            Response::redirect('404');
        }
    }

    public function action_delete($id = null) {
        if (Auth::has_access('material.manage')) {
        is_null($id) and Response::redirect('material');

        if ($material = Model_Material::find($id)) {
            
            $filename = $material->image;

            File::delete(DOCROOT . 'assets/img/materials/' . $filename);
            $material->delete();

            Session::set_flash('success', __('MATERIAL_DELETED_SUCCESS') . $id);
        } else {
            Session::set_flash('error', __('MATERIAL_DELETE_FAILURE') . $id);
        }

        Response::redirect('material');
    }else {
            Response::redirect('404');
        }
    }

}
