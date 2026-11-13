<?php

namespace App\Controllers; 
use CodeIgniter\Controller;

class RedirectModules extends BaseController
{
    public function index(){
        if (sess_role_code() === 'root' && !empty(sess_role_token()) && sess_group_code() === 'bc1c6e234794b4009f1c7abd49f662fc74f27335' && sess_logged_in() === 'is_secure_authentication') {
            return redirect()->to(base_url('admin/dashboard'));

          }elseif (sess_role_code() === 'admin' && !empty(sess_role_token()) && sess_group_code() === 'bc1c6e234794b4009f1c7abd49f662fc74f27335' && sess_logged_in() === 'is_secure_authentication') {
            return redirect()->to(base_url('admin/dashboard_prov'));
          
          }elseif (sess_role_code() === 'admin_kabkot' && !empty(sess_role_token()) && sess_group_code() === 'bc1c6e234794b4009f1c7abd49f662fc74f27335' && sess_logged_in() === 'is_secure_authentication') {
            return redirect()->to(base_url('admin/dashboard_kabkot'));
          
          }elseif (sess_role_code() === 'admin_kecamatan' && !empty(sess_role_token()) && sess_group_code() === 'bc1c6e234794b4009f1c7abd49f662fc74f27335' && sess_logged_in() === 'is_secure_authentication') {
            return redirect()->to(base_url('admin/dashboard_kec'));
          
          }elseif (sess_role_code() === 'admin_kelurahan' && !empty(sess_role_token()) && sess_group_code() === 'bc1c6e234794b4009f1c7abd49f662fc74f27335' && sess_logged_in() === 'is_secure_authentication') {
            return redirect()->to(base_url('admin/dashboard_kel'));
          
          }else{
            return redirect()->to('logout');
          }
    }
}
