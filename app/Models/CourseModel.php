<?php

namespace App\Models;

use CodeIgniter\Model;

class CourseModel extends Model
{
    protected $table = 'Course';
    protected $primaryKey = 'course_id';
    protected $allowedFields = [
        'title',
        'description',
        'category',
        'seo_title',
        'seo_description',
        'seo_keywords',
        'slug'
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    public function getPublishedCourses()
    {
        return $this->select('Course.*')
            ->where('title IS NOT NULL') // Simple published check
            ->orderBy('created_at', 'DESC')
            ->findAll(12);
    }

    public function getCourseBySlug(string $slug)
    {
        return $this->where('slug', $slug)->first();

    }

    public function getCourseById(int $course_id)
    {
        return $this->where('course_id', $course_id)->first();
    }
}
