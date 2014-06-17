<?php

//nodefinējam to, ka šis kontrolieris paplašina kontrolieri PUBLIC,
//lai tiktu izmantotas kopējās PUBLIC kontrolierī
//definētās funkcijas
class Controller_Employee extends Controller_Public {

//nepieciešams nodefinēt noklusējuma funkciju, ko
//kontrolieris pielietos, ja netiks norādīta cita funkcija

    public function action_index() {
//izsauc modeli Employee, norādot, ka nepieciešams atrast visus ierakstus
//šie ieraksti tiek ievietoti masīvā employees
        $data['employees'] = Model_Employee::find('all');
//nosaukuma un skatu ielādes bloka mainīgo definējumi, kurus izmanto
//lapas veidne.
        $this->template->title = __('EMPLOYEE_HEADER');
//tiek definēts, ka veidnei, ielasot šo mainīgo, nepieciešams
//atvērt konkrēto skatu, padodot no modeļa ielasīto masīvu ar speciālistiem
        $this->template->content = View::forge('employee/index', $data);
    }

//funkcija, kas atbildīga par speciālista ieraksta izveidi.
    public function action_create() {
//tiek pārbaudīts vai lietotājam ir tiesības izmantot šo funkciju
        if (Auth::has_access('employee.create')) {
            if (Input::method() == 'POST') {
//tiek nodefinēts mainīgais izsauks modeļa datu pārbaudes(validate) instanci
//
                $val = Model_Employee::validate('create');
//tiek pārbaudīts vai datu pārbaude ir veiksmīga
                if ($val->run()) {
//definē konkrētās augšupielādes konfigurāciju
                    $config = array(
                        'path' => DOCROOT . DS . 'assets/img/employee/',
                        'randomize' => true,
                        'ext_whitelist' => array('img', 'jpg', 'jpeg', 'gif', 'png'),
                    );
//tiek definēts, ka šis augšupielādes process izmantos augstāk norādīto konfigurāciju
                    Upload::process($config);
//ja augšupielāde izpilda nosacījumus
                    if (Upload::is_valid()) {
//veic augšupielādi
                        Upload::save();
//iegūst augšupielādētā attēla nosaukumu
                        $filename = Upload::get_files()[0]['saved_as'];
//pieškir paziņojuma mainīgajam vērtību no valodu faila masīva.
                        Session::set_flash('success', __('EMPLOYEE_IMAGE_UPLOAD_SUCCESS'));
                    } else {
//izdod kļūdu un novirza atpakaļ uz izveidošanas skatu
                        Session::set_flash('error', __('EMPLOYEE_IMAGE_NOT_VALID'));
                        Response::redirect('employee/create');
                    }
//modelim tiek nodoti mainigie un izsaukta veidošanas(forge) instance
                    $employee = Model_Employee::forge(array(
                                'name' => Input::post('name'),
                                'surname' => Input::post('surname'),
                                'email' => Input::post('email'),
                                'phonenumber' => Input::post('phonenumber'),
                                'description' => Input::post('description'),
                                'avatar' => $filename,
                    ));
//ja pievienošana veikta, padod paziņojumu un pārvirza uz speciālistu skatu
                    if ($employee and $employee->save()) {
                        Session::set_flash('success', __('EMPLOYEE_ADD_SUCCESS') . $employee->id . '.');

                        Response::redirect('employee');
                    } else {
//ja pievienošana nav veikta, padod kļūdas paziņojumu.
                        Session::set_flash('error', __('EMPLOYEE_ADD_ERROR'));
                    }
                } else {
                    Session::set_flash('error', $val->error());
                }
            }
            $this->template->title = __('EMPLOYEE_HEADER');
            $this->template->content = View::forge('employee/create');
        } else {
//ja lietotājam nav tiesību izpildīt šo funkciju, 
//lietotājs tiek novirzīts uz 404 kļūdas lapu, lai imitētu funkcijas neesamību
            Response::redirect('404');
        }
    }

//speciālista labošanas funkcija
    public function action_edit($id = null) {
        if (Auth::has_access('employee.manage')) {
//ja funkcija tiek izsaukta, nepadodot speciālista id,
//novirza uz specialistu sarakstu
            is_null($id) and Response::redirect('employee');
//ja neatrod konkrēto speciālista ierakstu
//padod kļūdu un novirza uz speciālistu sarakstu
            if (!$employee = Model_Employee::find($id)) {
                Session::set_flash('error', __('EMPLOYEE_FIND_ERROR') . $id);
                Response::redirect('employee');
            }

            $val = Model_Employee::validate('edit');
//pārbauda vai datu vaidācija veiksmīga
            if ($val->run()) {
//tiek ielasīta informācija no radiopogas
//kas satur informāciju vai lietotājs vēlas mainīt attēlu
                $upload = Input::post('upload');
//ja nevajag augšupielādēt jaunu attēlu
                if ($upload == '1') {
//pieškir ievadītās vērtības masīvam
                    $employee->name = Input::post('name');
                    $employee->surname = Input::post('surname');
                    $employee->email = Input::post('email');
                    $employee->phonenumber = Input::post('phonenumber');
                    $employee->description = Input::post('description');
                } else {
//ja nepieciešams veikt jaunu augšupielādi
                    $config = array(
                        'path' => DOCROOT . DS . 'assets/img/employee/',
                        'randomize' => true,
                        'ext_whitelist' => array('img', 'jpg', 'jpeg', 'gif', 'png'),
                    );

                    $filename = null;

                    Upload::process($config);
                    if (Upload::is_valid()) {
//nolasa iepriekšējo attēla nosaukumu
                        $oldfile = $employee->avatar;
//augšupielādē jauno attēlu
                        Upload::save();

                        $filename = Upload::get_files()[0]['saved_as'];
//izdzēš iepriekšējo attēlu
                        File::delete(DOCROOT . 'assets/img/employee/' . $oldfile);
                        Session::set_flash('success', __('EMPLOYEE_IMAGE_UPLOAD_SUCCESS'));
                    } else {
                        Session::set_flash('error', __('EMPLOYEE_IMAGE_NOT_VALID'));
                        Response::redirect('employee/edit/' . $id);
                    }

                    $employee->name = Input::post('name');
                    $employee->surname = Input::post('surname');
                    $employee->email = Input::post('email');
                    $employee->phonenumber = Input::post('phonenumber');
                    $employee->description = Input::post('description');
//ja ticis augšupielādēts attēls, piešķir masīvām vērtību,
//lai varētu augšupielādēt datubāzē
                    if ($filename != null) {
                        $employee->avatar = $filename;
                    } else {
                        $employee->avatar = Input::post('avatar');
                        Session::set_flash('error', __('EMPLOYEE_IMAGE_UPLOAD_FAILURE'));
                    }
                }
//saglabā ierakstu
                if ($employee->save()) {
//ja saglabāšana veiksmīga
                    Session::set_flash('success', __('EMPLOYEE_UPDATE_SUCCESS') . $upload);

                    Response::redirect('employee');
                } else {
                    Session::set_flash('error', __('EMPLOYEE_UPDATE_FAILURE') . $id);
                }
            } else {
//ja jauno datu validācija nav veiksmīga,
//iegūst iepriekš validētos datus
                if (Input::method() == 'POST') {

                    $employee->name = $val->validated('name');
                    $employee->surname = $val->validated('surname');
                    $employee->email = $val->validated('email');
                    $employee->phonenumber = $val->validated('phonenumber');
                    $employee->description = $val->validated('description');
                    $employee->avatar = $val->validated('avatar');

                    Session::set_flash('error', $val->error());
                }
//definē veidnes globālo mainīgo, kas padod validātos datus formai
                $this->template->set_global('employee', $employee, false);
            }

            $this->template->title = __('EMPLOYEE_HEADER');
            $this->template->content = View::forge('employee/edit');
        } else {
            Response::redirect('404');
        }
    }

//speciālista dzēšanas funkcija
    public function action_delete($id = null) {
        if (Auth::has_access('employee.manage')) {
            is_null($id) and Response::redirect('employee');
//izsauc modeli un iegūst masīvu, kurā ievietoti speciālista dati
            if ($employee = Model_Employee::find($id)) {
//iegūst avatara attēla datnes nosaukumu
                $filename = $employee->avatar;
//dzēš attēla datni no servera
                File::delete(DOCROOT . 'assets/img/employee/' . $filename);

//dzēš speciālistu
                $employee->delete();

                Session::set_flash('success', __('EMPLOYEE_DELETE_SUCCESS') . $id);
            } else {
                Session::set_flash('error', __('EMPLOYEE_DELETE_FAILURE') . $id);
            }

            Response::redirect('employee');
        } else {
            Response::redirect('404');
        }
    }

}
