<?php

namespace App\Controllers\V1;

use App\Controllers\BaseController;
use App\Exceptions\AccessDeniedException;
use App\Models\UserModel;
use App\Services\AuthService;
use App\Services\UserService;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\RedirectResponse;
use Config\Services;

class AuthController extends BaseController
{
    use ResponseTrait;

    private AuthService $authService;
    private UserService $userService;

    public function __construct()
    {
        $this->userService = new UserService(new UserModel());
        $this->authService = new AuthService(new UserModel());
        $this->validator = Services::validation();
    }

    public function login(): string
    {
        return view('login');
    }

    public function signUp(): RedirectResponse
    {
        $rules = $this->validator->getRuleGroup('createUser');
        $validationSuccess = $this->validate($rules);

        $data = [
            'first_name' => $this->request->getVar('first_name'),
            'last_name'  => $this->request->getVar('last_name'),
            'username'   => $this->request->getVar('username'),
            'email'      => $this->request->getVar('email'),
            'password'   => $this->request->getVar('password'),
            'mobile'     => $this->request->getVar('mobile')
        ];

        if (!$validationSuccess) {
            unset($data['password']);
            $data = [
                'errors' => $this->validator->getErrors(),
                'user'   => $data
            ];

            return redirect()->to('/register')->with('data', $data);
        }

        $userId = $this->userService->createUser($data);
        $user = $this->userService->findUser('id', $userId);

        $this->authService->createUserSession($user);

        $attributes = [
            'last_access_at'  => date('Y-m-d H:i:s'),
            'first_access_at' => date('Y-m-d H:i:s')
        ];

        $this->userService->updateUser($user['id'], $attributes);

        return redirect()->to('/user');
    }

    public function register(): string
    {
        return view('register');
    }

    public function authenticate(): RedirectResponse
    {
        try {
            $email = $this->request->getVar('email');
            $password = $this->request->getVar('password');

            $user = $this->authService->authenticate($email, $password);

            $this->authService->createUserSession($user);

            $attributes = [
                'last_access_at' => date('Y-m-d H:i:s')
            ];

            if (!$user['first_access_at']) {
                $attributes['first_access_at'] = date('Y-m-d H:i:s');
            }

            $this->userService->updateUser($user['id'], $attributes);

            return redirect()->to('/user');
        } catch (AccessDeniedException $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

    public function logout(): RedirectResponse
    {
        $this->authService->logout();

        return redirect()->to('/');
    }
}
