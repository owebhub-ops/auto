<?php

namespace App\Controllers\admin;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\RedirectResponse;

class AdminLoginController extends Controller
{
    public function index()
    {

        // Render the page content view
        $content = view('pages/admin/login');

        // Use layout_inner (like CourseController)
        return view('templates/layout_inner_home', [
            'pageData' => [
                'title'       => 'Lessons - Course',
                'description' => 'All lessons for this course.',
                'keywords'    => 'lessons, course lessons',
            ],
            'content' => $content
        ]);
    }
    public function authenticate()
    {
        $session = session();
    
        $validationRules = [
            'username' => 'required|min_length[3]|max_length[100]',
            'password' => 'required|min_length[6]|max_length[255]',
        ];
    
        if (! $this->validate($validationRules)) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Please enter a valid username and password.');
        }
    
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
    
        // Example: replace this with database lookup
        $admin = [
            'id'       => 1,
            'username' => 'admin',
            'name'     => 'Admin',
            'email'    => 'admin@onlinewebhub.com',
            'password' => password_hash('@Owh@2026$', PASSWORD_DEFAULT),
        ];
    
        if ($username === $admin['username'] && password_verify($password, $admin['password'])) {
            $session->regenerate(true);
    
            $session->set([
                'admin_id' => $admin['id'],
                'is_admin'  => true,
                'name'      => $admin['name'],
                'email'     => $admin['email'],
                'username'  => $admin['username'],
            ]);
    
            return redirect()->to(site_url('admin/dashboard'));
        }
    
        return redirect()->back()
            ->withInput()
            ->with('error', 'Invalid username or password.');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(site_url('admin/login'))->with('success', 'You have been logged out.');
    }
}