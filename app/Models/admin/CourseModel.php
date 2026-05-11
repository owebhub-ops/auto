<?php

namespace App\Models\admin;

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
        'slug',
        'created_at',
        'updated_at',
    ];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    public function getPublishedCourses()
    {
        return $this->where('status', 'published')->findAll();  // Or remove if using paginate directly
    }
}