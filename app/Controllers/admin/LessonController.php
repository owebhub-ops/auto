<?php

namespace App\Controllers\admin;

use App\Controllers\BaseController;
use App\Models\admin\LessonModel;
use App\Models\admin\CourseModel;

class LessonController extends BaseController
{
    protected $lessonModel;
    protected $courseModel;

    public function __construct()
    {
        helper(['form', 'url']);
        $this->lessonModel = new LessonModel();
        $this->courseModel = new CourseModel();
    }

    public function index($course_id)
    {
        $course = $this->courseModel->find($course_id);

        if (!$course) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Course not found');
        }

        $lessons = $this->lessonModel
            ->where('course_id', $course_id)
            ->orderBy('order_index', 'ASC')
            ->paginate(10, 'lessons');

        $pageData = [
            'course' => $course,
            'lessons' => $lessons,
            'pager' => $this->lessonModel->pager,
        ];

        return view('templates/admin/layout_admin', [
            'pageData' => $pageData,
            'content' => view('pages/admin/lesson/index', $pageData),
        ]);
    }

    public function create($courseId)
    {
        $course = $this->courseModel->find($courseId);
        if (!$course) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Course not found');
        }

        $pageData = ['course' => $course];
        return view('templates/admin/layout_admin', [
            'pageData' => $pageData,
            'content' => view('pages/admin/lesson/create', $pageData),
        ]);
    }

    public function store($courseId)
    {
        $course = $this->courseModel->find($courseId);
        if (!$course) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Course not found');
        }

        $validation = $this->validate([
            'title' => 'required|max_length[255]',
            'order_index' => 'required|integer|greater_than[0]',
            'slug' => 'permit_empty|max_length[255]|is_unique[lesson.slug]',
        ]);

        if (!$validation) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $slug = $this->request->getPost('slug');
        if (empty($slug)) {
            helper('text');
            $slug = url_title($this->request->getPost('title'), '-', true);
        }

        $this->lessonModel->save([
            'course_id' => $courseId,
            'title' => $this->request->getPost('title'),
            'content' => $this->request->getPost('content'),
            'order_index' => $this->request->getPost('order_index'),
            'seo_title' => $this->request->getPost('seo_title'),
            'seo_description' => $this->request->getPost('seo_description'),
            'seo_keywords' => $this->request->getPost('seo_keywords'),
            'slug' => $slug,
        ]);

        return redirect()->to(site_url("admin/course/{$courseId}/lesson"))
            ->with('success', 'Lesson created successfully.');
    }

    public function edit($courseId, $lessonId)
    {
        $course = $this->courseModel->find($courseId);
        if (!$course) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Course not found');
        }

        $lesson = $this->lessonModel->find($lessonId);
        if (!$lesson || $lesson['course_id'] != $courseId) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Lesson not found');
        }

        $pageData = ['course' => $course, 'lesson' => $lesson];
        return view('templates/admin/layout_admin', [
            'pageData' => $pageData,
            'content' => view('pages/admin/lesson/edit', $pageData),
        ]);
    }

    public function update($courseId, $lessonId)
    {
        $course = $this->courseModel->find($courseId);
        if (!$course) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Course not found');
        }

        $lesson = $this->lessonModel->find($lessonId);
        if (!$lesson || $lesson['course_id'] != $courseId) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Lesson not found');
        }

        $validation = $this->validate([
            'title' => 'required|max_length[255]',
            'order_index' => 'required|integer|greater_than[0]',
            'slug' => "permit_empty|max_length[255]|is_unique[lesson.slug,lesson_id,{$lessonId}]",
        ]);

        if (!$validation) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->lessonModel->update($lessonId, [
            'title' => $this->request->getPost('title'),
            'content' => $this->request->getPost('content'),
            'order_index' => $this->request->getPost('order_index'),
            'seo_title' => $this->request->getPost('seo_title'),
            'seo_description' => $this->request->getPost('seo_description'),
            'seo_keywords' => $this->request->getPost('seo_keywords'),
            'slug' => $this->request->getPost('slug') ?: url_title($this->request->getPost('title'), '-', true),
        ]);

        return redirect()->to(site_url("admin/course/{$courseId}/lesson"))
            ->with('success', 'Lesson updated successfully.');
    }

    public function delete($courseId, $lessonId)
    {
        $course = $this->courseModel->find($courseId);
        if (!$course) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Course not found');
        }

        $lesson = $this->lessonModel->find($lessonId);
        if (!$lesson || $lesson['course_id'] != $courseId) {
            return redirect()->to(site_url("admin/course/{$courseId}/lesson"))->with('error', 'Lesson not found.');
        }

        $this->lessonModel->delete($lessonId);
        return redirect()->to(site_url("admin/course/{$courseId}/lesson"))->with('success', 'Lesson deleted successfully.');
    }
}