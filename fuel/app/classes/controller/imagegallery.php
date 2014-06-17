<?php

class Controller_Imagegallery extends Controller_Public {

    public function action_index() {
        $data['imagegalleries'] = Model_Imagegallery::find('all');
        $this->template->title = "Imagegalleries";
        $this->template->content = View::forge('imagegallery/index', $data);
    }

    public function action_create() {
        if (Input::method() == 'POST') {

            $val = Model_Imagegallery::validate('create');

            if ($val->run()) {

                $config = array(
                    'path' => DOCROOT . DS . 'assets/img/gallery',
                    'randomize' => true,
                    'ext_whitelist' => array('img', 'jpg', 'jpeg', 'gif', 'png'),
                );

                Upload::process($config);
                if (Upload::is_valid()) {

                    Upload::save();

                    $filename = Upload::get_files()[0]['saved_as'];

                    Image::load(DOCROOT . 'assets/img/gallery/' . $filename)
                            ->crop_resize(150, 150)->save(DOCROOT . 'assets/img/gallery/thumbs/' . $filename);


                    Session::set_flash('success', 'Attēls pievienots veiksmīgi!');
                } else {
                    Session::set_flash('error', 'Image not valdid');
                    Response::redirect('imagegallery/create');
                }


                $imagegallery = Model_Imagegallery::forge(array(
                            'file' => $filename,
                            'description' => Input::post('description'),
                ));

                if ($imagegallery and $imagegallery->save()) {
                    Session::set_flash('success', 'Added imagegallery #' . $imagegallery->id . '.');

                    Response::redirect('imagegallery');
                } else {
                    Session::set_flash('error', 'Could not save imagegallery.');
                }
            } else {
                Session::set_flash('error', $val->error());
            }
        }

        $this->template->title = "Imagegalleries";
        $this->template->content = View::forge('imagegallery/create');
    }

    public function action_edit($id = null) {
        is_null($id) and Response::redirect('imagegallery');

        if (!$imagegallery = Model_Imagegallery::find($id)) {
            Session::set_flash('error', 'Could not find imagegallery #' . $id);
            Response::redirect('imagegallery');
        }

        $val = Model_Imagegallery::validate('edit');

        if ($val->run()) {
            $imagegallery->description = Input::post('description');

            if ($imagegallery->save()) {
                Session::set_flash('success', 'Updated imagegallery #' . $id);

                Response::redirect('imagegallery');
            } else {
                Session::set_flash('error', 'Could not update imagegallery #' . $id);
            }
        } else {
            if (Input::method() == 'POST') {
                $imagegallery->file = $val->validated('file');
                $imagegallery->description = $val->validated('description');

                Session::set_flash('error', $val->error());
            }

            $this->template->set_global('imagegallery', $imagegallery, false);
        }

        $this->template->title = "Imagegalleries";
        $this->template->content = View::forge('imagegallery/edit');
    }

    public function action_delete($id = null) {
        is_null($id) and Response::redirect('imagegallery');

        if ($imagegallery = Model_Imagegallery::find($id)) {

            $filename = $imagegallery->file;
            File::delete(DOCROOT . 'assets/img/gallery/' . $filename);
            File::delete(DOCROOT . 'assets/img/gallery/thumbs/' . $filename);

            $imagegallery->delete();

            Session::set_flash('success', 'Deleted imagegallery #' . $id);
        } else {
            Session::set_flash('error', 'Could not delete imagegallery #' . $id);
        }

        Response::redirect('imagegallery');
    }

}
