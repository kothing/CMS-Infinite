<?php

namespace App\Controllers;

use App\Models\AuthModel;
use App\Models\PostAdminModel;
use App\Models\SettingsModel;

class CommonController extends BaseController
{
    /**
     * Admin Login
     */
    public function adminLogin()
    {
        if (authCheck()) {
            if (isAdmin() || isAuthor()) {
                return redirect()->to(adminUrl());
            }
            return redirect()->to(base_url());
        }

        $data['title'] = trans("login");
        $data['description'] = trans("login") . " - " . $this->settings->site_title;
        $data['keywords'] = trans("login") . ', ' . $this->settings->application_name;
        echo view('admin/login', $data);
    }

    /**
     * Admin Login Post
     */
    public function adminLoginPost()
    {
        if (authCheck()) {
            return redirect()->to(adminUrl());
        }
        $val = \Config\Services::validation();
        $val->setRule('username', trans("username"), 'required|max_length[255]');
        $val->setRule('password', trans("password"), 'required|max_length[255]');
        if (!$this->validate(getValRules($val))) {
            $this->session->setFlashdata('errors', $val->getErrors());
            return redirect()->back()->withInput();
        } else {
            $username = inputPost('username');
            $user = $this->authModel->getUserByUsername($username);
            if (empty($user)) {
                $user = $this->authModel->getUserByUsername($username);
            }
            if (!empty($user) && !isAdmin() && $this->generalSettings->maintenance_mode_status == 1) {
                $this->session->setFlashdata('error', "Site under construction! Please try again later.");
                return redirect()->to(adminUrl('login'));
            }
            $result = $this->authModel->login();
            if ($result == "banned") {
                $this->session->setFlashdata('error', trans("message_ban_error"));
                return redirect()->to()->back();
            } elseif ($result == "success") {
                return redirect()->to(adminUrl());
            }
        }
        $this->session->setFlashdata('error', trans("login_error"));
        return redirect()->back()->withInput();
    }


    /**
     * Logout
     */
    public function logout()
    {
        $this->authModel->logout();
        return redirect()->back();
    }

    /**
     * Switch Mode
     */
    public function switchMode()
    {
        $infDarkMode = 0;
        $darkMode = inputPost('dark_mode');
        if ($darkMode == 1) {
            $infDarkMode = 1;
        }
        helperSetCookie('dark_mode', $infDarkMode);
        return redirect()->back();
    }

    /**
     * Logout
     */
    public function runInternalCron()
    {
        //delete old sessions
        $model = new SettingsModel();
        $model->deleteOldSessions();

        //delete old posts
        if ($this->generalSettings->auto_post_deletion == 1) {
            $postModel = new PostAdminModel();
            $postModel->deleteOldPosts();
        }
    }
}
