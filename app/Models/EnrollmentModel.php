<?php namespace App\Models;

use CodeIgniter\Model;

class EnrollmentModel extends Model
{
    protected $table = 'enrollments';
    protected $primaryKey = 'id';
    
    // ✅ FIXED: Only enrolled_at timestamp
    protected $useTimestamps = true;
    protected $createdField = 'enrolled_at';
    protected $updatedField = false;  // ✅ No updated_at column
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'user_id',
        'Course_id', 
        'progress',
        'completed_at'
    ];

    protected $validationRules = [
        'user_id' => 'required|is_not_unique[users.id]',
        'Course_id' => 'required|is_not_unique[Course.Course_id]',
        'progress' => 'permit_empty|numeric|less_than_equal_to[100]|greater_than_equal_to[0]',
        'completed_at' => 'permit_empty|valid_date'
    ];

    // Simplified - order by enrolled_at DESC (most recent first)
    public function getUserCourses($userId)
    {
        return $this->select('enrollments.*, Course.title, Course.slug, Course.seo_title')
                   ->join('Course', 'Course.Course_id = enrollments.Course_id', 'left')
                   ->where('enrollments.user_id', $userId)
                   ->orderBy('enrollments.enrolled_at', 'DESC')  // ✅ Use enrolled_at
                   ->findAll();
    }

    public function getUserStats($userId)
    {
        $total = $this->where('user_id', $userId)->countAllResults();
        $completed = $this->where('user_id', $userId)
                         ->where('progress >=', 90)
                         ->countAllResults();
        
        return [
            'total_Courses' => $total,
            'completed_Courses' => $completed,
            'in_progress' => $total - $completed,
            'completion_rate' => $total > 0 ? round(($completed / $total) * 100, 1) : 0
        ];
    }

    public function getRecentCourses($userId, $limit = 3)
    {
        return $this->select('enrollments.*, Course.title, Course.slug')
                   ->join('Course', 'Course.Course_id = enrollments.Course_id', 'left')
                   ->where('enrollments.user_id', $userId)
                   ->orderBy('enrollments.enrolled_at', 'DESC')  // ✅ enrolled_at
                   ->limit($limit)
                   ->findAll();
    }

    // Rest unchanged...
    public function enrollUser($userId, $CourseId)
    {
        $existing = $this->where('user_id', $userId)
                        ->where('Course_id', $CourseId)
                        ->first();

        if ($existing) {
            return $existing['id'];
        }

        $data = [
            'user_id' => $userId,
            'Course_id' => $CourseId,
            'progress' => 0
        ];

        if ($this->insert($data)) {
            return $this->getInsertID();
        }
        return false;
    }

    public function updateProgress($userId, $CourseId, $progress)
    {
        return $this->where('user_id', $userId)
                   ->where('Course_id', $CourseId)
                   ->set(['progress' => (float)$progress])
                   ->update();
    }

    public function completeCourse($userId, $CourseId)
    {
        return $this->where('user_id', $userId)
                   ->where('Course_id', $CourseId)
                   ->set([
                       'progress' => 100,
                       'completed_at' => date('Y-m-d H:i:s')
                   ])
                   ->update();
    }
}