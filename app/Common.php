<?php

/**
 * The goal of this file is to allow developers a location
 * where they can overwrite core procedural functions and
 * replace them with their own. This file is loaded during
 * the bootstrap process and is called during the framework's
 * execution.
 *
 * This can be looked at as a `master helper` file that is
 * loaded early on, and may also contain additional functions
 * that you'd like to use throughout your entire application
 *
 * @see: https://codeigniter.com/user_guide/extending/common.html
 */
if(!function_exists("formatDate")){
    function formatDate($date) {
        if (is_string($date)) {
            $timestamp = strtotime($date);
        } else {
            $timestamp = $date;
        }
        $format = date('d M Y H:i a', $timestamp);
        return $format;
    }
    
}
if(!function_exists("save_log")){
    function save_log($action){
        $logModel = model('LogModel');
        $date = date("Y-m-d H:i:s");
        $data = [
            'user' => get_logged_user_id(),  
            'action' => $action, 
            'time'=> $date
        ];
        $logModel->save($data);
    }
}

if(!function_exists("sendEmail")){
    function sendEmail($recipient, $subject, $message){
        $email = \Config\Services::email();
        $fromEmail = "noreplybiotime@zetech.ac.ke";
        $fromName  = "Biotime";
        $htmlMessage = "
        <!DOCTYPE html>
        <html>
        <head>
            <title>$subject</title>
        </head>
        <body>
            $message
        </body>
        </html>
        ";
        $email->setFrom($fromEmail, $fromName);
        $email->setTo($recipient);
        $email->setNewLine("\r\n");
        $email->setSubject($subject);
        $email->setMailType("html");
        $email->setMessage($htmlMessage);
       
        if(!$email->send()){
            $data = $email->printDebugger(['headers']);
            print_r($data);
        }

    }
}
if (!function_exists("calculate_hours_in")) {
    function calculate_hours_in($time_in, $time_out) {
        if ($time_out == '-') {
            return 'N/A';
        }

        $datetime1 = new DateTime($time_in);
        $datetime2 = new DateTime($time_out);
        $interval = $datetime1->diff($datetime2);

        // Format the interval as hours and minutes
        $hours = $interval->h;
        $minutes = $interval->i;

        return sprintf("%d hrs %d mins", $hours, $minutes);
    }
}

if(!function_exists("get_logged_user_names")){
    function get_logged_user_names() {
        if (session()->has('Biotimelogged')) {
            $loggedUser = session()->get('Biotimelogged');
            
            if (is_array($loggedUser) && isset($loggedUser['id'])) {
                return $loggedUser['FirstName'].' '.$loggedUser['LastName'];
            } elseif (is_object($loggedUser) && isset($loggedUser->id)) {
                return $loggedUser->FirstName.' '.$loggedUser->FirstName;
            }
        }
        return null;
    }
}
if(!function_exists("get_user_full_names")){
    function get_user_full_names($StaffID) {
            $userModel = model('StaffModel');
            $user = $userModel->getStaffByNo($StaffID);
            if (is_array($user)) {
                return $user['FirstName'].' '.$user['LastName'];
            } elseif (is_object($user)) {
                return $user->FirstName.' '.$user->LastName;
            }else{
                return "name not found";
            }
    }
}
if(!function_exists("get_user_names")){
    function get_user_names($id) {
            $userModel = model('BiotimeModel');
            $user = $userModel->getUserById($id);
            if (is_array($user)) {
                return $user['FirstName'].' '.$user['LastName'];
            } elseif (is_object($user)) {
                return $user->FirstName.' '.$user->LastName;
            }else{
                return "name not found";
            }
    }
}
if (!function_exists("get_name_initial")) {
    function get_name_initial() {
        if (session()->has('Biotimelogged')) {
            $loggedUser = session()->get('Biotimelogged');
            
            if (is_array($loggedUser) && isset($loggedUser['id'])) {
                $firstNameInitial = strtoupper(substr($loggedUser['FirstName'], 0, 1));
                return $firstNameInitial . '. ' . $loggedUser['LastName'];
            } elseif (is_object($loggedUser) && isset($loggedUser->id)) {
                $firstNameInitial = strtoupper(substr($loggedUser->fname, 0, 1));
                return $firstNameInitial . '. ' . $loggedUser->lname;
            }
        }
        return null;
    }
}

if (!function_exists('get_logged_user_id')) {
    function get_logged_user_id() {
        if (session()->has('Biotimelogged')) {
            $loggedUser = session()->get('Biotimelogged');
            if (is_array($loggedUser) && isset($loggedUser['id'])) {
                return $loggedUser['id'];
            } elseif (is_object($loggedUser) && isset($loggedUser->id)) {
                return $loggedUser->id;
            }
        }
        return null;
    }
}
if (!function_exists('get_logged_user_role')) {
    function get_logged_user_role() {
        if (session()->has('Biotimelogged')) {
            $loggedUser = session()->get('Biotimelogged');
            if (is_array($loggedUser) && isset($loggedUser['Role'])) {
                if($loggedUser['Role'] == "1"){
                    return "Super User";
                }elseif($loggedUser['Role'] == "2"){
                    return "Administrator";
                }else{
                    return "Default";
                }
            } elseif (is_object($loggedUser) && isset($loggedUser->Role)) {
                if($loggedUser['Role'] == "1"){
                    return "Super User";
                }elseif($loggedUser['Role'] == "2"){
                    return "Administrator";
                }else{
                    return "Default";
                }
            }
        }
        return null;
    }
}

if (!function_exists('get_logged_user_staffId')) {
    function get_logged_user_staffId() {
        if (session()->has('Biotimelogged')) {
            $loggedUser = session()->get('Biotimelogged');
            if (is_array($loggedUser) && isset($loggedUser['StaffID'])) {
                return $loggedUser['StaffID'];
            } elseif (is_object($loggedUser) && isset($loggedUser->StaffID)) {
                return $loggedUser->StaffID;
            }
        }
        return null;
    }
}

if (!function_exists('get_logged_user_campus')) {
    function get_logged_user_campus() {
        if (session()->has('Biotimelogged')) {
            $loggedUser = session()->get('Biotimelogged');
            if (is_array($loggedUser) && isset($loggedUser['Campus'])) {
                return $loggedUser['Campus'];
            } elseif (is_object($loggedUser) && isset($loggedUser->Campus)) {
                return $loggedUser->Campus;
            }
        }
        return null;
    }
}

if (!function_exists('get_logged_user_mail')) {
    function get_logged_user_mail() {
        if (session()->has('Biotimelogged')) {
            $loggedUser = session()->get('Biotimelogged');
            if (is_array($loggedUser) && isset($loggedUser['Email'])) {
                return $loggedUser['Email'];
            } elseif (is_object($loggedUser) && isset($loggedUser->Email)) {
                return $loggedUser->Email;
            }
        }
        return null;
    }
}
if (!function_exists('get_logged_user_pass_reset')) {
    function get_logged_user_pass_reset() {
       $userModel = model("BiotimeModel");
       $user = $userModel->getUserById(get_logged_user_id());
       if(!empty($user)){
            return $user['reset_pass'];
       }else{
            return null;
       }
    }
}