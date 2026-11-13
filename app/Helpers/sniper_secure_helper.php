<?php 

/** 
| sess_user_account
**/
if (!function_exists('sess_user_account')) {
    function sess_user_account() {
       
        $session = session();
        $account = $session->user_account_id;
        return $account;
    }
}

if (!function_exists('sess_role_access')) {
    function sess_role_access() {
       
        $session = session();
        $account = $session->role_access_id;
        return $account;
    }
}

if (!function_exists('sess_group_access')) {
    function sess_group_access() {
       
        $session = session();
        $account = $session->group_account_id;
        return $account;
    }
}

if (!function_exists('sess_full_name')) {
    function sess_full_name() {
       
        $session = session();
        $account = $session->user_account_full_name;
        return $account;
    }
}

if (!function_exists('sess_nick_name')) {
    function sess_nick_name() {
       
        $session = session();
        $account = $session->user_account_nick_name;
        return $account;
    }
}

if (!function_exists('sess_username')) {
    function sess_username() {
       
        $session = session();
        $account = $session->user_account_username;
        return $account;
    }
}

if (!function_exists('sess_hashing')) {
    function sess_hashing() {
       
        $session = session();
        $account = $session->user_account_hashing;
        return $account;
    }
}

if (!function_exists('sess_photo')) {
    function sess_photo() {
       
        $session = session();
        $account = $session->user_account_photo;
        return $account;
    }
}

if (!function_exists('sess_email')) {
    function sess_email() {
       
        $session = session();
        $account = $session->user_account_email;
        return $account;
    }
}

if (!function_exists('sess_bidang')) {
    function sess_bidang() {
       
        $session = session();
        $account = $session->bidang_id;
        return $account;
    }
}

if (!function_exists('sess_contact')) {
    function sess_contact() {
       
        $session = session();
        $account = $session->user_account_contact;
        return $account;
    }
}

if (!function_exists('sess_role_code')) {
    function sess_role_code() {
       
        $session = session();
        $account = $session->role_access_code;
        return $account;
    }
}

if (!function_exists('sess_role_name')) {
    function sess_role_name() {
       
        $session = session();
        $account = $session->role_access_name;
        return $account;
    }
}

if (!function_exists('sess_role_token')) {
    function sess_role_token() {
       
        $session = session();
        $account = $session->role_access_token;
        return $account;
    }
}

if (!function_exists('sess_group_code')) {
    function sess_group_code() {
       
        $session = session();
        $account = $session->group_account_code;
        return $account;
    }
}


if (!function_exists('sess_logged_in')) {
    function sess_logged_in() {
       
        $account = 'is_secure_authentication';
        return $account;
    }
}

if (!function_exists('sess_bidang')) {
    function sess_bidang() {
       
        $session = session();
        $account = $session->bidang_id;
        return $account;
    }
}

if (!function_exists('sess_year')) {
    function sess_year() {
       
        $session = session();
        $account = $session->sess_year;
        return $account;
    }
}

if (!function_exists('sess_region')) {
    function sess_region() {
       
        $session = session();
        $account = $session->region;
        return $account;
    }
}

if (!function_exists('sess_kecamatan')) {
    function sess_kecamatan() {
       
        $session = session();
        $account = $session->kecamatan;
        return $account;
    }
}

if (!function_exists('sess_kelurahan')) {
    function sess_kelurahan() {
       
        $session = session();
        $account = $session->kelurahan;
        return $account;
    }
}

