<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ContactMessageModel;  // Fixed: matches your model name

class AdminContactController extends BaseController
{
    protected $contactModel;

    public function __construct()
    {
        $this->contactModel = new ContactMessageModel();
        helper(['form', 'url']);
    }

    public function index()
    {
        $pageData = [
            'title' => 'All Contacts - Admin Contact Management',
            'description' => 'Manage and view all contact form submissions and inquiries.',
            'keywords' => 'contact messages, inquiries, admin contacts, support tickets'
        ];

        // ✅ ALREADY SHOWS LATEST FIRST (newest on top)
        $contacts = $this->contactModel
            ->orderBy('created_at', 'DESC')  // DESC = newest first
            ->paginate(10, 'default');

        $pageData['contacts'] = $contacts;
        $pageData['pager'] = $this->contactModel->pager;

        $content = view('pages/admin/contact/index', $pageData);

        return view('templates/admin/layout_admin', [
            'pageData' => $pageData,
            'content' => $content
        ]);
    }

    public function show($id)
    {
        $contact = $this->contactModel->find($id);
        if (!$contact) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Contact not found');
        }

        $pageData = [
            'title' => 'View Contact - ' . $contact['subject'],
            'contact' => $contact
        ];

        $content = view('pages/admin/contact/show', $pageData);

        return view('templates/admin/layout_admin', [
            'pageData' => $pageData,
            'content' => $content
        ]);
    }

    public function destroy($id)
    {
        $contact = $this->contactModel->find($id);
        if (!$contact) {
            return redirect()->to(site_url('admin/contact'))->with('error', 'Contact not found.');
        }

        $this->contactModel->delete($id);
        return redirect()->to(site_url('admin/contact'))->with('success', 'Contact deleted successfully.');
    }
}