<?php

namespace App\Controllers;
use App\Models\LoginModel;

class Login extends BaseController
{

    public function index()
    {
        return view('login/login_view');
    }

    public function masuk(){
        $data = $this->request->getPost();
        $validate = $this->validation->run($data, 'masuk');
        $errors = $this->validation->getErrors();

        if($errors){
            return $this->response->setJSON($errors)->setStatusCode(400);
        } else{
            $cekUser = $this->loginModel->where('username', $data['username'])->first();

            if($cekUser){
                if($cekUser['password'] == $data['password']){
                    $session = [
                        'username' => $cekUser['username'],
                        'password' => $cekUser['password'],
                        'npk' => $cekUser['npk'],
                        'nama' => $cekUser['nama'],
                        'kode_jabatan' => $cekUser['kode_jabatan'],
                        'id_division' => $cekUser['id_division'],
                        'id_department' => $cekUser['id_department'],
                        'id_section' => $cekUser['id_section'],
                        'department' => $cekUser['department'],
                        'division' => $cekUser['division'],
                        'section' => $cekUser['section']
                    ];
                    
                    session()->set($session);

                    return $this->response->setJSON(['messages' => 'Log In Successfull!']);
                } else{
                    return $this->response->setJSON(['error' => 'wrong password!'])->setStatusCode(404);
                }
            } else{
                return $this->response->setJSON(['error' => 'Username Undefined!'])->setStatusCode(404);
            }
        }
    }

    public function logout(){
        session()->destroy();
        return redirect()->to('./');
    }
    
    public function loginToExternalApi() {
        $api_url = 'https://portal3.incoe.astra.co.id/production_control_v2/public/api/login';
        $this->validation = \Config\Services::validation();
        $this->loginModel = new LoginModel();
    
        $data = $this->request->getPost();
        $validate = $this->validation->run($data, 'masuk');
        $errors = $this->validation->getErrors();
    
        if ($errors) {
            return $this->response->setJSON($errors)->setStatusCode(400);
        } else {
            $api_data = [
                'username' => $data['username'],
                'password' => $data['password']
            ];
    
            $options = [
                'http' => [
                    'method' => 'POST',
                    'header' => 'Content-type: application/x-www-form-urlencoded',
                    'content' => http_build_query($api_data)
                ]
            ];
    
            $context = stream_context_create($options);
            $response = file_get_contents($api_url, false, $context);
    
            $authData = json_decode($response, true);
    
            if ($authData && isset($authData['username'])) {
                $session = [
                    'username' => $authData['username'],
                    'npk' => $authData['npk'],
                    'nama' => $authData['nama'],
                    'kode_jabatan' => $authData['kode_jabatan'],
                    'id_division' => $authData['id_divisi'],
                    'id_department' => $authData['id_departement'],
                    'id_section' => $authData['id_section'],
                    'section' => $authData['section'],
                    'division' => $authData['divisi'],
                    'department' => $authData['departement'],
                    'password' => $data['password'],
                    'type_karyawan' => $data['type_karyawan']
                ];
    
                session()->set($session);
                
                $existingUser = $this->loginModel->where('npk', session()->get('npk'))->first();
                // dd(session()->get('npk'));
                // $npk = session()->get('npk');
                // $dataType = gettype($npk);
                // dd($dataType);
                
                if (!$existingUser) {
                    $datauser = [
                        'username' => session()->get('username'),
                        'npk' => session()->get('npk'),
                        'nama' => session()->get('nama'),
                        'id_department' => session()->get('id_department'),
                        'id_division' => session()->get('id_division'),
                        'id_section' => session()->get('id_section'),
                        'division' => session()->get('division'),
                        'department' => session()->get('department'),
                        'section' => session()->get('section'),
                        // 'password' => $data['password'],
                        'kode_jabatan' => session()->get('kode_jabatan')
                    ];
                    
                    $this->loginModel->insert($datauser);
                }
    
                return $this->response->setJSON(['messages' => 'Log In Successfull!']);
            } else {
                return $this->response->setJSON(['error' => 'Wrong Username or Password'])->setStatusCode(404);
            }
        }
    }
}