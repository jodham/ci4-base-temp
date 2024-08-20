<?php

namespace App\Controllers;
use CodeIgniter\Exceptions\PageNotFoundException;
class Users extends BaseController
{
    public function users(){
        if (!session()->has('Biotimelogged')) {
            return redirect()->to('/login');
        }
        $page = 'users';
        if (! is_file(APPPATH . 'Views/users/' . $page . '.php')) {
            throw new PageNotFoundException($page);
        } 
        $usersModel = model('StaffModel');
        $data['users'] = $usersModel->getUsers();

        $data['content'] = view('users/users', $data, []);
        return view('index/base', $data);
    }
    public function add_user(){
        if (!session()->has('Biotimelogged')) {
            return redirect()->to('/login');
        }
        $page = 'add_user';
        if (! is_file(APPPATH . 'Views/users/' . $page . '.php')) {
            throw new PageNotFoundException($page);
        } 
        $usersModel = model('BiotimeModel');
        $data['users'] = $usersModel->getUsers();
       
        $data['email'] = '';
        $data['first_name'] = '';
        $data['last_name'] = '';
        $data['role'] = '';
        $data['status'] = '';
        $data['staffId'] = '';
       
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $email = $this->request->getPost('email');
            $first_name = $this->request->getPost('first_name');
            $last_name = $this->request->getPost('last_name');
            $staffId = $this->request->getPost('staffId');
            $role = $this->request->getPost('role');
            
            $domain = explode('@', $email);
          
            if($domain[1] != 'zetech.ac.ke'){
                $data['email'] = $email;
                $data['first_name'] = $first_name;
                $data['last_name'] = $last_name;
                $data['role'] = $role;
                $data['staffId'] = $staffId;
                session()->setFlashdata('error', 'Invalid email, use a valid zetech email address');
                $data['content'] = view('users/add_user', $data, []);
                return view('index/base', $data);
            }
            
            // Check if user already exists
            $user = $usersModel->getUserByEmail($email);
            if(!empty($user)){
                $data['email'] = $email;
                $data['first_name'] = $first_name;
                $data['last_name'] = $last_name;
                $data['role'] = $role;
                $data['staffId'] = $staffId;
                session()->setFlashdata('error', 'user with this email already exists');
                $data['content'] = view('users/add_user', $data, []);
                return view('index/base', $data);
            }
            $userStaffId = $usersModel->getUserByStaffId($staffId);
            if(!empty($userStaffId)){
                $data['email'] = $email;
                $data['first_name'] = $first_name;
                $data['last_name'] = $last_name;
                $data['role'] = $role;
                $data['staffId'] = $staffId;
                session()->setFlashdata('error', 'user with this Staff Id already exists');
                $data['content'] = view('users/add_user', $data, []);
                return view('index/base', $data);
            }
            $password = $this->generate_password();
            
            $data = array(
                'email' => $email,
                'first_name' => $first_name,
                'last_name' => $last_name,
                'role' => $role,
                'status' => 1, 
                'reset_pass' => 1,
                'password' => md5($password),
                'staffId' => $staffId,
                'date_added' => date('Y-m-d H:i:s')
            );
            
            $usersModel->save($data);
            save_log("added new user"." ".$first_name." ".$last_name);
            $message = "Dear"." ".$first_name." ".$last_name.",<br>"."Your account in"." ".base_url()." "."has been created"."<br>"."password: "." ".$password;
            $subject = "Biotime Account Creation";
            sendEmail($email, $subject, $message);
            session()->setFlashdata('success', 'success, added user'." ".$first_name." ".$last_name);
            return redirect()->to('/users');
        }

        $data['content'] = view('users/add_user', $data, []);
        return view('index/base', $data);
    }
    public function edit_user($id) {
        if (!session()->has('Biotimelogged')) {
            return redirect()->to('/login');
        }
    
        $page = 'edit_user';
        if (!is_file(APPPATH . 'Views/users/' . $page . '.php')) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
        }
    
        $usersModel = model('StaffModel');
        $user = $usersModel->getUserById($id);
    
        if ($user === null) {
            session()->setFlashdata('error', 'User not found');
            return redirect()->to('/users'); // Or another appropriate fallback
        }
    
        $data = [
            'id' => $user['id'],
            'email' => $user['Email'],
            'first_name' => $user['FirstName'],
            'last_name' => $user['LastName'],
            'role' => $user['Role'],
            'status' => $user['Status'],
            'staffId' => $user['StaffID'],
        ];
    
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $this->request->getPost('email');
            $first_name = $this->request->getPost('first_name');
            $last_name = $this->request->getPost('last_name');
            $staffId = $this->request->getPost('staffId');
            $role = $this->request->getPost('role');
            $resetpass = $this->request->getPost('resetpass');
           
            $domain = explode('@', $email);
            if ($domain[1] != 'zetech.ac.ke') {
                session()->setFlashdata('error', 'Invalid email, use a valid zetech email address');
                $data = array_merge($data, compact('email', 'first_name', 'last_name', 'staffId', 'role'));
                $data['content'] = view('users/edit_user', $data);
                return view('index/base', $data);
            }
    
            $existingUser = $usersModel->getUserByEmail($email);
            if ($existingUser && $existingUser['id'] != $id) {
                session()->setFlashdata('error', 'User with this email already exists');
                $data = array_merge($data, compact('email', 'first_name', 'last_name', 'staffId', 'role'));
                $data['content'] = view('users/edit_user', $data);
                return view('index/base', $data);
            }
    
            // $existingStaffId = $usersModel->getUserByStaffId($staffId);
            // if ($existingStaffId && $existingStaffId['id'] != $id) {
            //     session()->setFlashdata('error', 'User with this Staff ID already exists');
            //     $data = array_merge($data, compact('email', 'first_name', 'last_name', 'staffId', 'role'));
            //     $data['content'] = view('users/edit_user', $data);
            //     return view('index/base', $data);
            // }

            // $password = $user['password'];
            $password = '';
            $reset_pass = 0;
            if($resetpass == "1"){
                $raw_password = $this->generate_password();
                $password = md5($raw_password);
                $reset_pass = 1;
            }
            
            $updateData = array(
                'Role' => $role
            );
            
            if($usersModel->update($id, $updateData)) {
                // save_log('Edited user details for ' .$first_name . ' ' . $last_name);
                if($resetpass == "1"){
                    $message = "Dear " . $first_name . ' ' . $last_name . ",<br>Your password in <a href=\"" . base_url() . "\">Biotime</a> has been reset to<br> password: " . $raw_password;
                    $subject = "Biotime password reset";
                    sendEmail($email, $subject, $message);
                }
                session()->setFlashdata('success', 'Success, edited role for ' . $first_name . ' ' . $last_name);

                return redirect()->to("/users");
            } else {
                session()->setFlashdata('error', 'Error occurred! Try again.');
            }
        }
    
        $data['content'] = view('users/edit_user', $data);
        return view('index/base', $data);
    }
    public function disable_user($id) {
        $usersModel = model('StaffModel');
        $user = $usersModel->find($id);
        
        if ($user) {
            $user['Status'] = 0; // Set status to 'Disabled'
            $usersModel->update($id, $user);
            return $this->response->setJSON(['success' => true, 'message' => 'User disabled successfully']);
        } else {
            return $this->response->setJSON(['success' => false, 'message' => 'User not found']);
        }
    }
    public function enable_user($id) {
        $usersModel = model('StaffModel');
        $user = $usersModel->find($id);
        
        if ($user) {
            $user['Status'] = 1; // Set status to 'Disabled'
            $usersModel->update($id, $user);
            return $this->response->setJSON(['success' => true, 'message' => 'User activated successfully']);
        } else {
            return $this->response->setJSON(['success' => false, 'message' => 'User not found']);
        }
    }
    public function generate_password($length = 8) {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_-=+;:,.?";
        $password = "";
        for ($i = 0; $i < $length; $i++) {
            $password .= $chars[rand(0, strlen($chars)-1)];
        }
        
        if (!preg_match("#[a-z]+#", $password)) {
            $password .= strtolower($chars[rand(0, 25)]);
        }
        if (!preg_match("#[A-Z]+#", $password)) {
            $password .= strtoupper($chars[rand(0, 25)]);
        }
        if (!preg_match("#[0-9]+#", $password)) {
            $password .= $chars[rand(52, 61)];
        }
        if (!preg_match("#[\W]+#", $password)) {
            $password .= $chars[rand(62, strlen($chars)-1)];
        }
        return $password;
    }
    public function validate_password_format($password, $length = 8) {
        // Check the length of the password
        if (strlen($password) < $length) {
            return false;
        }
    
        // Check for at least one lowercase letter
        if (!preg_match("#[a-z]+#", $password)) {
            return false;
        }
    
        // Check for at least one uppercase letter
        if (!preg_match("#[A-Z]+#", $password)) {
            return false;
        }
    
        // Check for at least one digit
        if (!preg_match("#[0-9]+#", $password)) {
            return false;
        }
    
        // Check for at least one special character
        if (!preg_match("#[\W]+#", $password)) {
            return false;
        }
    
        // If all checks pass, return true
        return true;
    }
    
    public function forgotpassword(){
        $page = 'forgot_password';
        if (! is_file(APPPATH . 'Views/index/' . $page . '.php')) {
            throw new PageNotFoundException($page);
        }

		$data['email'] = '';
		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			$email = $this->request->getPost('email');

            $domain = explode('@', $email);
           
            if($domain[1] != 'zetech.ac.ke'){
                $data['email'] = $email;
             
                session()->setFlashdata('error', 'Invalid email, use a valid zetech email address');
                $data['content'] = view('users/forgot_password', $data, []);
                return view('index/base', $data);
            }
            // Check if user already exists
            $user = $usersModel->getUserByEmail($email);
            if(empty($user)){
                $data['email'] = $email;
                session()->setFlashdata('error', 'user with this email does not exist');
                $data['content'] = view('users/forgot_password', $data, []);
                return view('index/base', $data);
            }

			$tkn = uniqid();
			$expiryTime = date("Y-m-d H:i", strtotime("+1 hour"));

			$message = "Password reset link:\r\n\r\n" . base_url() . "resetPassword?user=" . $email . "&tkn=" . $tkn . "\r\n\r\n";
            
			$message .= "This link will expire at " . $expiryTime;

            sendEmail($email, "Biotime password reset", $message);
			
			$data = array(
				'user' => $email,
				'token' => $tkn,
				'expiry_time' => $expiryTime
			);
            $tokenModel = model("TokenModel");
            $tokenModel->save($data);
			redirect()->to('/signin');
		}
		$data['content'] = $this->load->view('index/forgot_password', $data, true);
		$this->load->view('index/base', $data);
	}
    public function reset_password(){
        if (!session()->has('Biotimelogged')) {
            return redirect()->to('/login');
        }
        $page = 'reset_password';
        if (! is_file(APPPATH . 'Views/users/' . $page . '.php')) {
            throw new PageNotFoundException($page);
        }
        $userModel = model("BiotimeModel");
        $user = $userModel->getUserByEmail(get_logged_user_mail());
        $data['current_password'] =  '';
        $data['new_password'] =  '';
        $data['confirm_password'] =  '';
		if($_SERVER['REQUEST_METHOD'] == "POST"){
            $current_pass = $this->request->getPost('current_pass');
			$pass1 = $this->request->getPost('pass1');
			$pass2 = $this->request->getPost('pass2');

            if(md5($current_pass) != $user['password']){
                $data['current_password'] =  $current_pass;
                $data['new_password'] =  $pass1;
                $data['confirm_password'] =  $pass2;
                session()->setFlashdata('error', 'current password is incorrect');
                $data['content'] = view('users/reset_password', $data, []);
                return view('index/base', $data);
            }
			if($this->validate_password_format($pass1, $length = 8)){
                
				if($pass1 == $pass2){
					$data = array(
						"password"=> md5($pass1),
                        "reset_pass" => 0,
						"date_modified" => date("Y-m-d H:i:s")
					);
					
                    if($userModel->update($user['id'], $data)){
                        session()->setFlashdata('success', 'password reset success');
                        return redirect()->to('/'); 
                    }

				}else{
                    $data['current_password'] =  $current_pass;
                    $data['new_password'] =  $pass1;
                    $data['confirm_password'] =  $pass2;
                    session()->setFlashdata('error', 'New passwords do not match');
                    $data['content'] = view('users/reset_password', $data, []);
                    return view('index/base', $data);
				}
			}else{
                $data['current_password'] =  $current_pass;
                $data['new_password'] =  $pass1;
                $data['confirm_password'] =  $pass2;
                session()->setFlashdata('error', 'Password does not meet requirement, try again');
                $data['content'] = view('users/reset_password', $data, []);
                return view('index/base', $data);
				}
		}

		$data['content'] = view('users/reset_password', $data, []);
        return view('index/base', $data);
    }
    public function forgot_password(){
        $page = 'forgot_password';
        if (! is_file(APPPATH . 'Views/users/' . $page . '.php')) {
            throw new PageNotFoundException($page);
        }
        $data['email'] = '';
        $data['staffno'] = '';
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            $email = $this->request->getPost('email');
            $staffNo = $this->request->getPost('staffno');

            $domain = explode('@', $email);
           
            if($domain[1] != 'zetech.ac.ke'){
                $data['email'] = $email;
             
                session()->setFlashdata('error', 'Invalid email, use a valid zetech email address');
                $data['content'] = view('users/forgot_password', $data, []);
                return view('index/base', $data);
            }

            $userModel = model('BiotimeModel');
            $user = $userModel->getUser($email, $staffNo);
            if(!empty($user)){
                $pass = $this->generate_password();
                $data = array(
                    'password' => md5($pass),
                    'reset_pass' => 1
                );

                if($userModel->update($user['id'], $data)){
                    $message = "Dear"." ".$user['first_name']." ".$user['last_name'].",<br>"."Your password in"." ".base_url()." "."has been reset to"."<br>"."password: "." ".$pass;
                    $subject = "Biotime Password Reset";
                    sendEmail($email, $subject, $message);
                    session()->setFlashdata('success', 'password reset success, check email');
                    return redirect()->to("/login");
                }else{
                    $data['email'] = $email;
                    $data['staffno'] = $staffNo;
                    session()->setFlashdata('error', 'error occured try again');
                    $data['content'] = view('users/forgot_password', $data, []);
                    return view('index/base', $data);
                }
            }else{
                $data['email'] = $email;
                $data['staffno'] = $staffNo;
                session()->setFlashdata('error', 'incorrect email/staff number, try again');
                $data['content'] = view('users/forgot_password', $data, []);
                return view('index/base', $data);
            }
        }
        $data['content'] = view('users/forgot_password', $data, []);
        return view('index/base', $data);
    }
}