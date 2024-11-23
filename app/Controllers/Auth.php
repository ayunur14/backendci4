<?php

namespace App\Controllers;

class Auth extends BaseController
{
    public function __construct()
    {
        helper(['form', 'url']); // Muat helper form dan URL di constructor
    }

    public function login()
    {
        // Aturan validasi untuk login
        $rules = [
            'email' => 'required|valid_email',
            'password' => 'required|min_length[8]',
        ];

        if ($this->request->getMethod() == 'post') {
            dd($this->request->getPost());
            // Validasi input
            if ($this->validate($rules)) {
                // Jika validasi berhasil
                echo "Login success!";
                // Redirect ke halaman dashboard
                return redirect()->to('/dashboard');
            } else {
                // Jika validasi gagal, kirimkan pesan kesalahan
                $data['validation'] = $this->validator;
                return view('auth/login', $data); // Ubah path view
            }
        }

        return view('auth/login'); // Ubah path view
    }

    public function register()
    {
        // Aturan validasi untuk register
        $rules = [
            'name' => 'required|trim',
            'email' => [
                'rules' => 'required|trim|valid_email|is_unique[users.email]',
                'errors' => [
                    'required' => 'Email harus diisi.',
                    'valid_email' => 'Format email tidak valid.',
                    'is_unique' => 'Email ini sudah terdaftar.',
                ],
            ],
            'password1' => [
                'rules' => 'required|trim|min_length[8]|matches[password2]',
                'errors' => [
                    'required' => 'Password harus diisi.',
                    'min_length' => 'Password terlalu pendek.',
                    'matches' => 'Password tidak cocok.',
                ],
            ],
            'password2' => [
                'rules' => 'required|trim|matches[password1]',
                'errors' => [
                    'required' => 'Konfirmasi password harus diisi.',
                    'matches' => 'Konfirmasi password tidak cocok.',
                ],
            ],
        ];

        if ($this->request->getMethod() == 'post') {
            // Validasi input
            if ($this->validate($rules)) {
                // Jika validasi berhasil
                echo "Registration success!";
                // Proses registrasi, seperti menyimpan data ke database
                return redirect()->to('/login');
            } else {
                // Jika validasi gagal, kirimkan pesan kesalahan
                $data['validation'] = $this->validator;
                return view('auth/register', $data); // Ubah path view
            }
        }

        return view('auth/register'); // Ubah path view
    }
}
