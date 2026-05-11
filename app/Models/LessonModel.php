<?php

namespace App\Models;

use CodeIgniter\Model;

class LessonModel extends Model
{
    protected $table      = 'Lesson';
    protected $primaryKey = 'lesson_id';
    protected $allowedFields = [
        'course_id', 'title', 'content', 'order_index',
        'seo_title', 'seo_description', 'seo_keywords', 'slug',
    ];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
