<?php

namespace App\Controllers;
use CodeIgniter\Exceptions\PageNotFoundException;
class Home extends BaseController
{

    public function index(){
        if (!session()->has('Biotimelogged')) {
            return redirect()->to('/login');
        }
        if(get_logged_user_role() == "Default"){
            return redirect()->to('/myattendance');
        }
        $page = 'index';
        if (! is_file(APPPATH . 'Views/index/' . $page . '.php')) {
            throw new PageNotFoundException($page);
        }
        $data['content'] = view('index/index', [], []); 
        return view('index/base', $data);
    }
    
    public function signin(){
        if(session()->has('Biotimelogged')){
            return redirect()->to('/');  
        }
        $page = 'login';
        if (! is_file(APPPATH . 'Views/index/' . $page . '.php')) {
            throw new PageNotFoundException($page);
        }
        $data = [
            'email' => '',
            'password' => ''
        ];
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');
            
            $userModel = model('UserModel');
            $user  = $userModel->getUserByEmail($email);
           
            if($user){
                if($user['Status'] == "0"){
                    session()->setFlashdata('error', 'Account disabled,  contact admin.');
                    $data['content'] = view('index/login', $data, []);
                    return view('index/base', $data);
                }
                if ($user['StaffID'] == $password) {
                  
                    session()->set('Biotimelogged', $user);
                    // save_log('user logged in'); 
                    
                    // if(get_logged_user_pass_reset() == "1"){
                    //     session()->setFlashdata('error', 'Change password to proceed');
                    //     return redirect()->to('/reset_password');
                    // }
                    return redirect()->to('/'); 
                } else {
                    $data = [
                        'email' => $email,
                        'password' => $password
                    ];

                    session()->setFlashdata('error', 'Invalid password,  please try again.');
                    $data['content'] = view('index/login', $data, []);
                    return view('index/base', $data);
                }
            }else{
                $data = [
                    'email' => $email,
                    'password' => $password
                ];
                session()->setFlashdata('error', 'User does not exist, please try again.');
                $data['content'] = view('index/login', $data, []);
                return view('index/base', $data);
            }
        }
        $data['content'] = view('index/login', $data, []); 
        return view('index/base', $data);
    }
       
    public function sign(){
        if(session()->has('Biotimelogged')){
            return redirect()->to('/');  
        }
        $page = 'login';
        if (! is_file(APPPATH . 'Views/index/' . $page . '.php')) {
            throw new PageNotFoundException($page);
        }
        $data = [
            'email' => '',
            'password' => ''
        ];
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');
            
            $userModel = model('BiotimeModel');
            $user  = $userModel->getUserByEmail($email);

            if($user){
                if($user['status'] == "0"){
                    session()->setFlashdata('error', 'Account disabled,  contact admin.');
                    $data['content'] = view('index/login', $data, []);
                    return view('index/base', $data);
                }
                if ($user['password'] == md5($password)) {
                  
                    session()->set('Biotimelogged', $user);
                    save_log('user logged in'); 
                    
                    if(get_logged_user_pass_reset() == "1"){
                        session()->setFlashdata('error', 'Change password to proceed');
                        return redirect()->to('/reset_password');
                    }
                    return redirect()->to('/'); 
                } else {
                    $data = [
                        'email' => $email,
                        'password' => $password
                    ];

                    session()->setFlashdata('error', 'Invalid password,  please try again.');
                    $data['content'] = view('index/login', $data, []);
                    return view('index/base', $data);
                }
            }else{
                $data = [
                    'email' => $email,
                    'password' => $password
                ];
                session()->setFlashdata('error', 'User does not exist, please try again.');
                $data['content'] = view('index/login', $data, []);
                return view('index/base', $data);
            }
        }
        $data['content'] = view('index/login', $data, []); 
        return view('index/base', $data);
    }
    public function signout(){
        if (session()->has('Biotimelogged')) {
            // save_log('user logged out'); 
            session()->destroy();
            return redirect()->to('/login');
        } else {
            return redirect()->to('/login');
        }
    }
    public function profile(){
        if (!session()->has('Biotimelogged')) {
            return redirect()->to('/login');
        }
        $page = 'profile';
        if (! is_file(APPPATH . 'Views/index/' . $page . '.php')) {
            throw new PageNotFoundException($page);
        }
        $usersModel = model('UserModel');
        $data['user'] = $usersModel->getUserByEmail(get_logged_user_mail());
        $data['content'] = view('index/profile', $data, []); 
        return view('index/base', $data);
    }

    public function logs(){
        if (!session()->has('Biotimelogged')) {
            return redirect()->to('/login');
        }
        $page = 'logs';
        if (! is_file(APPPATH . 'Views/index/' . $page . '.php'))
        {
            throw new PageNotFoundException($page);
        }
        $limit = 100;
        $page = $this->request->getVar('page') ? $this->request->getVar('page') : 1;
        $pager = \Config\Services::pager();

        $data['user'] = '';
        $data['station'] = '';
        $data['direction'] = '';
        $data['date_from'] = '';
        $data['date_to'] = '';

        $logModel = model('LogModel');
        $data['logs'] = $logModel->getLogs($page, $limit);

        $totalRecords = count($data['logs']);
        $data['pager'] = $pager->makeLinks($page, $limit, $totalRecords);
        $data['content'] = view('index/logs', $data, []);
        return view('index/base', $data);
            
    }
}