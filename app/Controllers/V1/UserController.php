<?php

namespace App\Controllers\V1;

use App\Controllers\BaseController;
use App\Exceptions\NotFoundException;
use App\Models\UserModel;
use App\Services\UserService;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;

class UserController extends BaseController
{
    use ResponseTrait;

    private UserService $userService;

    public function __construct()
    {
        $this->userService = new UserService(new UserModel());
        $this->validator = Services::validation();
    }

    public function index(): string
    {
        return view('user/list');
    }

    public function store(): RedirectResponse
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
            $data = [
                'errors' => $this->validator->getErrors(),
                'user'   => $data
            ];

            return redirect()->back()->with('data', $data);
        }

        $this->userService->createUser($data);

        return redirect()->to('/user')->with('message', 'User created with success');
    }

    public function update(int $id): RedirectResponse
    {
        $rules = $this->validator->getRuleGroup('updateUser');
        $rules['email']['rules'] = str_replace('{$id}', $id, $rules['email']['rules']);
        $rules['username']['rules'] = str_replace('{$id}', $id, $rules['username']['rules']);
        $validationSuccess = $this->validate($rules);

        $data = array_filter([
            'first_name' => $this->request->getVar('first_name'),
            'last_name'  => $this->request->getVar('last_name'),
            'username'   => $this->request->getVar('username'),
            'email'      => $this->request->getVar('email'),
            'password'   => $this->request->getVar('password'),
            'mobile'     => $this->request->getVar('mobile')
        ]);

        if (!$validationSuccess) {
            $data = [
                'errors' => $this->validator->getErrors(),
                'user'   => $data
            ];

            return redirect()->back()->with('data', $data);
        }

        $this->userService->updateUser($id, $data);

        return redirect()->to('user')->with('message', 'User created with success');
    }

    public function delete(int $id): ResponseInterface
    {
        $this->userService->deleteUser($id);

        return $this->respond([
            'message' => 'User deleted with success!'
        ]);
    }

    public function edit(int $id): string
    {
        try {
            $user = $this->userService->findUser('id', $id);

            return view('user/form', compact('user'));
        } catch (NotFoundException $exception) {
            return view('user/list', [
                'error' => $exception->getMessage()
            ]);
        }
    }

    public function changeStatus(int $id): ResponseInterface
    {
        try {
            $user = $this->userService->findUser('id', $id);

            $this->userService->updateUser($id, [
                'active' => !$user['active']
            ]);

            return $this->respond([
                'message' => 'Success'
            ]);
        } catch (NotFoundException $exception) {
            $notFoundCode = 404;
            return $this->respond([
                'error' => $exception->getMessage()
            ], $notFoundCode);
        }
    }

    public function create(): string
    {
        return view('user/form');
    }

    public function list(): ResponseInterface
    {
        $length = intval($this->request->getVar('length'));
        $start = intval($this->request->getVar('start'));
        $search = $this->request->getVar('search');
        $page = $start / $length + 1;

        $filters = [];
        if ($search['value'] ?? false) {
            $filters['search'] = $search['value'];
        }

        $order = $this->request->getVar('order');
        if ($order) {
            $filters['order'] = [
                'column' => current($order)['column_name'],
                'direction' => current($order)['dir'],
            ];
        }

        $columns = [
            'id',
            'first_name',
            'last_name',
            'email',
            'username',
            'mobile',
            'active',
            'last_access_at',
        ];

        $data = $this->userService->paginateUsers($filters, $length, $page, $columns);

        return $this->respond($data);
    }


}
