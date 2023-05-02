<?php

namespace App\Controllers;

use App\Models\AuthModel;
use App\Models\EmailModel;
use App\Models\NewsletterModel;

class AuthController extends BaseController
{
    /**
     * Login
     */
    public function login()
    {
        if (authCheck()) {
            return redirect()->to(langBaseUrl());
        }

        $data['title'] = trans("login");
        $data['description'] = trans("login") . " - " . $this->settings->application_name;
        $data['keywords'] = trans("login") . "," . $this->settings->application_name;

        echo view('partials/_header', $data);
        echo view('auth/login', $data);
        echo view('partials/_footer');
    }

    /**
     * Login Post
     */
    public function loginPost()
    {
        if (authCheck()) {
            return redirect()->to(langBaseUrl());
        }
        $val = \Config\Services::validation();
        $val->setRule('username', trans("username"), 'required|max_length[255]');
        $val->setRule('password', trans("password"), 'required|max_length[255]');
        if (!$this->validate(getValRules($val))) {
            $this->session->setFlashdata('errors', $val->getErrors());
            return redirect()->back()->withInput();
        } else {
            $model = new AuthModel();
            $result = $model->login();
            if ($result == "banned") {
                $this->session->setFlashdata('error', trans("message_ban_error"));
                return redirect()->back()->withInput();
            } elseif ($result == "success") {
                $redirect = inputPost('redirectUrl');
                return redirect()->to($redirect);
            }
        }
        $this->session->setFlashdata('error', trans("login_error"));
        return redirect()->back()->withInput();
    }

    /**
     * Connect with Facebook
     */
    public function connectWithFacebook()
    {
        require_once APPPATH . "ThirdParty/facebook/vendor/autoload.php";
        $fbUrl = "https://www.facebook.com/v3.3/dialog/oauth?client_id=" . $this->generalSettings->facebook_app_id . "&redirect_uri=" . langBaseUrl() . "/facebook-callback&scope=email&state=" . generateToken();
        $this->session->set('fbLoginReferrer', previous_url());
        return redirect()->to($fbUrl);
    }

    /**
     * Facebook Callback
     */
    public function facebookCallback()
    {
        require_once APPPATH . "ThirdParty/facebook/vendor/autoload.php";
        $fb = new \Facebook\Facebook([
            'app_id' => $this->generalSettings->facebook_app_id,
            'app_secret' => $this->generalSettings->facebook_app_secret,
            'default_graph_version' => 'v2.10',
        ]);
        try {
            $helper = $fb->getRedirectLoginHelper();
            $permissions = ['email'];
            if (isset($_GET['state'])) {
                $helper->getPersistentDataHandler()->set('state', $_GET['state']);
            }
            $accessToken = $helper->getAccessToken();
            if (empty($accessToken)) {
                return redirect()->to(langBaseUrl());
            }
            $response = $fb->get('/me?fields=name,email', $accessToken);
        } catch (\Facebook\Exceptions\FacebookResponseException $e) {
            echo 'Graph returned an error: ' . $e->getMessage();
            exit();
        } catch (\Facebook\Exceptions\FacebookSDKException $e) {
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit();
        }

        $user = $response->getGraphUser();
        $fbUser = new \stdClass();
        $fbUser->id = $user->getId();
        $fbUser->email = $user->getEmail();
        $fbUser->name = $user->getName();

        $model = new AuthModel();
        $model->loginWithFacebook($fbUser);

        if (!empty($this->session->get('fbLoginReferrer'))) {
            return redirect()->to($this->session->get('fbLoginReferrer'));
        } else {
            return redirect()->to(langBaseUrl());
        }
    }

    /**
     * Connect with Google
     */
    public function connectWithGoogle()
    {
        require_once APPPATH . "ThirdParty/google/vendor/autoload.php";
        $provider = new \League\OAuth2\Client\Provider\Google([
            'clientId' => $this->generalSettings->google_client_id,
            'clientSecret' => $this->generalSettings->google_client_secret,
            'redirectUri' => base_url('connect-with-google'),
        ]);

        if (!empty($_GET['error'])) {
            exit('Got error: ' . htmlspecialchars($_GET['error'], ENT_QUOTES, 'UTF-8'));
        } elseif (empty($_GET['code'])) {
            $authUrl = $provider->getAuthorizationUrl();
            $_SESSION['oauth2state'] = $provider->getState();
            $this->session->set('gLoginReferrer', previous_url());
            return redirect()->to($authUrl);
        } elseif (empty($_GET['state']) || ($_GET['state'] !== $_SESSION['oauth2state'])) {
            unset($_SESSION['oauth2state']);
            exit('Invalid state');
        } else {
            $token = $provider->getAccessToken('authorization_code', [
                'code' => $_GET['code']
            ]);
            try {
                $user = $provider->getResourceOwner($token);
                $gUser = new \stdClass();
                $gUser->id = $user->getId();
                $gUser->email = $user->getEmail();
                $gUser->name = $user->getName();
                $gUser->avatar = $user->getAvatar();

                $model = new AuthModel();
                $model->loginWithGoogle($gUser);

                if (!empty($this->session->get('gLoginReferrer'))) {
                    return redirect()->to($this->session->get('gLoginReferrer'));
                } else {
                    return redirect()->to(langBaseUrl());
                }
            } catch (Exception $e) {
                exit('Something went wrong: ' . $e->getMessage());
            }
        }
    }

    /**
     * Register
     */
    public function register()
    {
        if (authCheck() || $this->generalSettings->registration_system != 1) {
            return redirect()->to(langBaseUrl());
        }

        $data['title'] = trans("register");
        $data['description'] = trans("register") . " - " . $this->settings->application_name;
        $data['keywords'] = trans("register") . "," . $this->settings->application_name;

        echo view('partials/_header', $data);
        echo view('auth/register', $data);
        echo view('partials/_footer');
    }

    /**
     * Register Post
     */
    public function registerPost()
    {
        if (authCheck() || $this->generalSettings->registration_system != 1) {
            return redirect()->to(langBaseUrl());
        }
        $val = \Config\Services::validation();
        $val->setRule('username', trans("username"), 'required|min_length[4]|max_length[255]|is_unique[users.username]');
        $val->setRule('email', trans("email"), 'required|valid_email|max_length[255]|is_unique[users.email]');
        $val->setRule('password', trans("password"), 'required|min_length[4]|max_length[255]');
        $val->setRule('confirm_password', trans("confirm_password"), 'required|matches[password]');
        if (!$this->validate(getValRules($val))) {
            $this->session->setFlashdata('errors', $val->getErrors());
            return redirect()->back()->withInput();
        } else {
            if (reCAPTCHA('validate', $this->generalSettings) == 'invalid') {
                $this->session->setFlashdata('error', trans("msg_recaptcha"));
                return redirect()->back()->withInput();
            } else {
                $model = new AuthModel();
                if ($model->register()) {
                    $this->session->setFlashdata('success', trans("msg_register_success"));
                    return redirect()->to(langBaseUrl('settings'));
                }
            }
        }
        $this->session->setFlashdata('error', trans("msg_error"));
        return redirect()->back();
    }

    /**
     * Forgot Password
     */
    public function forgotPassword()
    {
        if (authCheck() || $this->generalSettings->registration_system != 1) {
            return redirect()->to(langBaseUrl());
        }

        $data['title'] = trans("forgot_password");
        $data['description'] = trans("forgot_password") . " - " . $this->settings->application_name;
        $data['keywords'] = trans("forgot_password") . "," . $this->settings->application_name;

        echo view('partials/_header', $data);
        echo view('auth/forgot_password');
        echo view('partials/_footer');
    }

    /**
     * Forgot Password Post
     */
    public function forgotPasswordPost()
    {
        if (authCheck() || $this->generalSettings->registration_system != 1) {
            return redirect()->to(langBaseUrl());
        }
        $email = inputPost('email');
        $user = $this->authModel->getUserByEmail($email);
        if (empty($user)) {
            $this->session->setFlashdata('error', trans("reset_password_error"));
        } else {
            $emailModel = new EmailModel();
            $emailModel->sendEmailResetPassword($user->id);
            $this->session->setFlashdata('success', trans("msg_reset_password_success"));
        }
        return redirect()->to(base_url('forgot-password'));
    }

    /**
     * Reset Password
     */
    public function resetPassword()
    {
        if (authCheck() || $this->generalSettings->registration_system != 1) {
            return redirect()->to(langBaseUrl());
        }

        $data['title'] = trans("reset_password");
        $data['description'] = trans("reset_password") . " - " . $this->settings->application_name;
        $data['keywords'] = trans("reset_password") . "," . $this->settings->application_name;

        $token = inputGet('token', true);
        $data["user"] = $this->authModel->getUserByToken($token);
        $data["pass_reset_completed"] = $this->session->getFlashdata('pass_reset_completed');

        if (empty($data["user"]) && empty($data["pass_reset_completed"])) {
            return redirect()->to(langBaseUrl());
        }

        echo view('partials/_header', $data);
        echo view('auth/reset_password');
        echo view('partials/_footer');
    }


    /**
     * Reset Password Post
     */
    public function resetPasswordPost()
    {
        $val = \Config\Services::validation();
        $val->setRule('password', trans("password"), 'required|min_length[4]|max_length[255]');
        $val->setRule('password_confirm', trans("confirm_password"), 'required|matches[password]');
        if (!$this->validate(getValRules($val))) {
            $this->session->setFlashdata('errors', $val->getErrors());
            return redirect()->back()->withInput();
        } else {
            $token = inputPost('token');
            if ($this->authModel->resetPassword($token)) {
                $this->session->setFlashdata('pass_reset_completed', 1);
                $this->session->setFlashdata('success', trans("message_change_password"));
            } else {
                $this->session->set_flashdata('error', trans("change_password_error"));
            }
        }
        return redirect()->back();
    }

    /**
     * Unsubscribe
     */
    public function unsubscribe()
    {
        $data['title'] = trans("unsubscribe");
        $data['description'] = trans("unsubscribe");
        $data['keywords'] = trans("unsubscribe");

        $token = inputGet("token");
        $model = new NewsletterModel();
        $subscriber = $model->getSubscriberByToken($token);
        if (empty($subscriber)) {
            return redirect()->to(base_url());
        }
        $model->unsubscribeEmail($subscriber->email);

        echo view('partials/_header', $data);
        echo view('auth/unsubscribe');
        echo view('partials/_footer');
    }
}
