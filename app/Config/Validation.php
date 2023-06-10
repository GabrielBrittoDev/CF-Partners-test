<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Validation\StrictRules\CreditCardRules;
use CodeIgniter\Validation\StrictRules\FileRules;
use CodeIgniter\Validation\StrictRules\FormatRules;
use CodeIgniter\Validation\StrictRules\Rules;

class Validation extends BaseConfig
{
    // --------------------------------------------------------------------
    // Setup
    // --------------------------------------------------------------------

    /**
     * Stores the classes that contain the
     * rules that are available.
     *
     * @var string[]
     */
    public array $ruleSets = [
        Rules::class,
        FormatRules::class,
        FileRules::class,
        CreditCardRules::class,
    ];

    /**
     * Specifies the views that are used to display the
     * errors.
     *
     * @var array<string, string>
     */
    public array $templates = [
        'list'   => 'CodeIgniter\Validation\Views\list',
        'single' => 'CodeIgniter\Validation\Views\single',
    ];

    // --------------------------------------------------------------------
    // Rules
    // --------------------------------------------------------------------

    public array $createUser = [
        'first_name'       => [
            'label' => 'first name',
            'rules' => 'required|alpha_numeric_space|min_length[2]|max_length[255]',
        ],
        'last_name'        => [
            'label' => 'last name',
            'rules' => 'required|alpha_numeric_space|min_length[2]|max_length[255]',
        ],
        'username'         => [
            'rules'  => 'required|alpha_numeric_punct|min_length[3]|max_length[80]|is_unique[users.username]',
            'errors' => [
                'is_unique' => 'The username is already in use.'
            ]
        ],
        'email'            => [
            'rules'  => 'required|valid_email|is_unique[users.email]',
            'errors' => [
                'is_unique' => 'The email is already in use.'
            ]
        ],
        'mobile'           => [
            'rules' => 'required|numeric|max_length[15]|min_length[9]',
        ],
        'password'         => [
            'rules' => 'required|min_length[8]|max_length[50]',
        ],
        'confirm_password' => [
            'label' => 'confirm password',
            'rules' => 'required|matches[password]',
        ],
    ];

    public array $updateUser = [
        'first_name'       => [
            'label' => 'first name',
            'rules' => 'required|alpha_numeric_space|min_length[2]|max_length[255]',
        ],
        'last_name'        => [
            'label' => 'last name',
            'rules' => 'required|alpha_numeric_space|min_length[2]|max_length[255]',
        ],
        'username'         => [
            'rules'  => 'required|alpha_numeric_punct|min_length[3]|max_length[80]|is_unique[users.username,id,{$id}]',
            'errors' => [
                'is_unique' => 'The username is already in use.'
            ]
        ],
        'email'            => [
            'rules'  => 'required|valid_email|is_unique[users.email,id,{$id}]',
            'errors' => [
                'is_unique' => 'The email is already in use.'
            ]
        ],
        'mobile'           => [
            'rules' => 'required|numeric|max_length[15]|min_length[9]',
        ],
        'password'         => [
            'rules' => 'permit_empty|min_length[8]|max_length[50]',
        ],
        'confirm_password' => [
            'label' => 'confirm password',
            'rules' => 'required_with[password]|permit_empty|matches[password]',
        ],
    ];
}
