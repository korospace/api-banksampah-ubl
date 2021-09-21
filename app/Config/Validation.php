<?php

namespace Config;

use CodeIgniter\Validation\CreditCardRules;
use CodeIgniter\Validation\FileRules;
use CodeIgniter\Validation\FormatRules;
use CodeIgniter\Validation\Rules;

class Validation
{
    //--------------------------------------------------------------------
    // Setup
    //--------------------------------------------------------------------

    /**
     * Stores the classes that contain the
     * rules that are available.
     *
     * @var string[]
     */
    public $ruleSets = [
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
    public $templates = [
        'list'   => 'CodeIgniter\Validation\Views\list',
        'single' => 'CodeIgniter\Validation\Views\single',
    ];

    //--------------------------------------------------------------------
    // Rules
    //--------------------------------------------------------------------
	public $nasabahRegister = [
		'email' => [
			'rules'  => 'required|min_length[8]|max_length[40]|is_unique[nasabah.email]|valid_email',
			'errors' => [
                'required'    => 'email is required',
                'min_length'  => 'min 8 character',
                'max_length'  => 'max 40 character',
                'is_unique'   => 'email is exist',
                'valid_email' => 'Email is not in format',
			]
		],
		'username' => [
            'rules'  => 'required|min_length[8]|max_length[20]|is_unique[nasabah.username]',
            'errors' => [
                'required'    => 'username is required',
                'min_length'  => 'min 8 character',
                'max_length'  => 'max 20 character',
                'is_unique'   => 'username is exist',
            ],
		],
		'password' => [
            'rules'  => 'required|min_length[8]|max_length[20]',
            'errors' => [
                'required'    => 'password is required',
                'min_length'  => 'min 8 character',
                'max_length'  => 'max 20 character',
            ],
		],
		'nama_lengkap' => [
            'rules'  => 'required|min_length[6]|max_length[40]|is_unique[nasabah.nama_lengkap]',
            'errors' => [
                'required'    => 'nama lengkap is required',
                'min_length'  => 'min 6 character',
                'max_length'  => 'max 40 character',
                'is_unique'   => 'nama lengkap is exist',
            ],
		],
		'notelp' => [
            'rules'  => 'required|min_length[6]|max_length[12]|is_unique[nasabah.notelp]',
            'errors' => [
                'required'    => 'nomor telepon is required',
                'min_length'  => 'min 6 character',
                'max_length'  => 'max 12 character',
                'is_unique'   => 'no.telp is exist',
            ],
		],
		'alamat' => [
            'rules'  => 'required|min_length[10]|max_length[255]',
            'errors' => [
                'required'    => 'alamat is required',
                'min_length'  => 'min 10 character',
                'max_length'  => 'max 255 character',
            ],
		],
		'rt' => [
            'rules'  => 'required|min_length[2]|max_length[2]',
            'errors' => [
                'required'    => 'rt is required',
                'min_length'  => 'min 2 character',
                'max_length'  => 'max 2 character',
            ],
		],
		'rw' => [
            'rules'  => 'required|min_length[2]|max_length[2]',
            'errors' => [
                'required'    => 'rw is required',
                'min_length'  => 'min 2 character',
                'max_length'  => 'max 2 character',
            ],
		],
		'tgl_lahir' => [
            'rules'  => 'required|min_length[11]|max_length[16]',
            'errors' => [
                'required'    => 'tgl lahir is required',
                'min_length'  => 'min 11 character',
                'max_length'  => 'max 16 character',
            ],
		],
		'kelamin' => [
            'rules'  => 'required|min_length[9]|max_length[9]',
            'errors' => [
                'required'    => 'kelamin is required',
                'min_length'  => 'min 9 character',
                'max_length'  => 'max 9 character',
            ],
		]
	];

	public $codeOTP = [
		'code_otp' => [
            'rules'  => 'required|min_length[6]|max_length[6]',
            'errors' => [
                'required'    => 'code_otp is required',
                'min_length'  => 'min 6 character',
                'max_length'  => 'max 6 character',
            ],
		]
	];

	public $nasabahLogin = [
		'email' => [
            'rules'  => 'required|valid_email',
            'errors' => [
                'required'    => 'email is required',
                'valid_email' => 'Email is not in format',
            ],
		],
		'password' => [
            'rules'  => 'required',
            'errors' => [
                'required'    => 'password is required',
            ],
		],
	];
    
	public $editProfileNasabah = [
		'username' => [
            'rules'  => 'required|min_length[8]|max_length[20]|is_unique[nasabah.username,nasabah.id,{id}]',
            'errors' => [
                'required'    => 'username is required',
                'min_length'  => 'min 8 character',
                'max_length'  => 'max 20 character',
                'is_unique'   => 'username is exist',
            ],
		],
		'nama_lengkap' => [
            'rules'  => 'required|min_length[6]|max_length[40]|is_unique[nasabah.nama_lengkap,nasabah.id,{id}]',
            'errors' => [
                'required'    => 'nama lengkap is required',
                'min_length'  => 'min 6 character',
                'max_length'  => 'max 40 character',
                'is_unique'   => 'nama lengkap is exist',
            ],
		],
		'notelp' => [
            'rules'  => 'required|min_length[6]|max_length[12]|is_unique[nasabah.notelp,nasabah.id,{id}]',
            'errors' => [
                'required'    => 'nomor telepon is required',
                'min_length'  => 'min 6 character',
                'max_length'  => 'max 12 character',
                'is_unique'   => 'no.telp is exist',
            ],
		],
		'alamat' => [
            'rules'  => 'required|min_length[6]|max_length[255]',
            'errors' => [
                'required'    => 'alamat is required',
                'min_length'  => 'min 6 character',
                'max_length'  => 'max 255 character',
            ],
		],
		'tgl_lahir' => [
            'rules'  => 'required|min_length[6]|max_length[20]',
            'errors' => [
                'required'    => 'tgl lahir is required',
                'min_length'  => 'min 6 character',
                'max_length'  => 'max 20 character',
            ],
		],
		'kelamin' => [
            'rules'  => 'required|min_length[6]|max_length[10]',
            'errors' => [
                'required'    => 'kelamin is required',
                'min_length'  => 'min 6 character',
                'max_length'  => 'max 10 character',
            ],
		]
	];
}
