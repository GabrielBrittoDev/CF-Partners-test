<?php

namespace App\Services;

use App\Exceptions\AccessDeniedException;
use App\Models\UserModel;
use CodeIgniter\Session\Session;

class AuthService
{
    public function __construct(
        private readonly UserModel $userModel
    ) {
    }

    /**
     * Create a new user with the data.
     *
     * @param string $credential Username or email to authenticate.
     * @param string $password Password to authenticate.
     *
     * @return array Created user data
     *
     * @throws AccessDeniedException
     **
     * @access public
     */
    public function authenticate(string $credential, string $password): array
    {
        $user = $this->userModel->where('email', $credential)
            ->orWhere('username', $credential)
            ->first();

        if (!$user) {
            throw new AccessDeniedException('Invalid username or password.');
        }

        if (!$user['active'] || $user['deleted_at']) {
            throw new AccessDeniedException('User inactive, contact an administrator!');
        }

        $verified = password_verify($password, $user['password']);

        if (!$verified) {
            throw new AccessDeniedException('Invalid username or password.');
        }

        return $user;
    }

    /**
     * Create a session with the given data.
     *
     * @param array $user Array containing the session info.
     *    $params = [
     *      'id'         => (int) User ID. Required.
     *      'first_name' => (string) First name. Required.
     *      'last_name'  => (string) Last name Required.
     *      'email'      => (string) Email Required.
     *
     * @return Session Session created.
     *
     * @access public
     */
    public function createUserSession(array $user): Session
    {
        $session = session();

        $data = [
            'id' => $user['id'],
            'first_name' => $user['first_name'],
            'last_name' => $user['last_name'],
            'email' => $user['email'],
            'isLoggedIn' => true
        ];
        $session->set($data);

        return $session;
    }



    /**
     * Destroy user session
     *
     * @access public
     */
    public function logout(): void
    {
        session()->destroy();
    }
}