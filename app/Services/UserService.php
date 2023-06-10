<?php

namespace App\Services;

use App\Exceptions\NotFoundException;
use App\Models\UserModel;

class UserService
{
    public function __construct(
        private readonly UserModel $userModel
    ) {
    }

    /**
     * Create a new user with the data.
     *
     * @param array $data Array containing the necessary params.
     *    $params = [
     *      'first_name'=> (string) First name. Required.
     *      'last_name' => (string) Last name. Required.
     *      'username'  => (string) Username. Required.
     *      'email'     => (string) Email. Required.
     *      'mobile'    => (int) Mobile number. Required.
     *      'password'  => (string) Password. Required.
     *
     * @return int Created user id
     *
     * @access public
     */
    public function createUser(array $data): int
    {
        $password = password_hash($data['password'], PASSWORD_DEFAULT);

        $this->userModel->insert([
            'first_name' => $data['first_name'],
            'last_name'  => $data['last_name'],
            'username'   => $data['username'],
            'email'      => $data['email'],
            'password'   => $password,
            'mobile'     => $data['mobile'],
        ]);

        return $this->userModel->getInsertID();
    }

    /**
     * Search in the database using the column and value passed.
     *
     * @param string $field User table column.
     * @param mixed $value Value to search.
     *
     * @return array User info
     *
     * @throws NotFoundException
     *
     * @access public
     */
    public function findUser(string $field, mixed $value): array
    {
        $user = $this->userModel->where($field, $value)->first();

        if (!$user) {
            throw new NotFoundException('not found');
        }

        return $user;
    }

    /**
     * Update user using the parameters.
     *
     * @param int $id User ID
     * @param array $attributes Array containing the necessary params.
     *    $params = [
     *      'first_name'=> (string) First name. Optional.
     *      'last_name' => (string) Last name. Optional.
     *      'username'  => (string) Username. Optional.
     *      'email'     => (string) Email. Optional.
     *      'mobile'    => (int) Mobile number. Optional.
     *      'password'  => (string) Password. Optional.
     *    ]
     *
     * @return bool Update success
     *
     * @access public
     */
    public function updateUser(int $id, array $attributes): bool
    {
        if ($attributes['password'] ?? false) {
            $attributes['password'] = password_hash($attributes['password'], PASSWORD_DEFAULT);
        }

        return $this->userModel->update($id, $attributes);
    }

    /**
     * Delete user

     * @param int $id User id to delete
     * @param bool $forceDelete Case true soft delete is not applied
     *
     * @return bool Operation result
     *
     * @access public
     */
    public function deleteUser(int $id, bool $forceDelete = false): bool
    {
        return $this->userModel->delete($id, $forceDelete);
    }

    /**
     * Paginated user list
     *
     * @param array $filters
     *    $filters = [
     *      'search'    => (string) Search using first_name, last_name, email and username columns. Optional.
     *      'order'     => (array) Optional [
     *          'column' => (String) Database column for the sort. Required.
     *          'direction' => (String) ASC for ascending order, DESC for descending order. Required.
     *      ]
     *    ]
     * @param int $length Page length, Default 10
     * @param int $page Actual page Default 1
     * @param array $columns Database columns to get
     *
     * @return array Pagination data
     *
     * @access public
     */
    public function paginateUsers(
        array $filters,
        int $length = 10,
        int $page = 1,
        array $columns = ['*']
    ): array {
        $builder = $this->userModel->select($columns)->where('deleted_at', null);

        if ($filters['search'] ?? false) {
            $value = $filters['search'];
            $builder = $builder->groupStart()
                ->like('first_name', $value)
                ->orLike('last_name', $value)
                ->orLike('email', $value)
                ->orLike('username', $value)
                ->groupEnd();
        }

        if ($filters['order'] ?? false) {
            $orderColumn = $filters['order']['column'];
            $orderDirection = $filters['order']['direction'];

            $builder = $builder->orderBy($orderColumn, $orderDirection);
        }


        $users = $builder->paginate($length, 'default', $page);

        return [
            'data'            => $users,
            'recordsTotal'    => $builder->pager->getTotal(),
            'recordsFiltered' => $builder->pager->getTotal()
        ];
    }
}