<?php

namespace App\Models\admin;

use CodeIgniter\Model;

class LessonModel extends Model
{
    protected $table = 'Lesson';
    protected $primaryKey = 'lesson_id';
    protected $allowedFields = [
        'course_id', 'title', 'content', 'order_index',
        'seo_title', 'seo_description', 'seo_keywords',
        'slug', 'created_at', 'updated_at'
    ];
}