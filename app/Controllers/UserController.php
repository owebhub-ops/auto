<?php namespace App\Controllers;

use App\Models\UserModel;
use App\Models\CourseModel;
use App\Models\EnrollmentModel;
use CodeIgniter\Controller;

class UserController extends Controller
{
    protected $userModel;
    protected $courseModel;
    protected $enrollmentModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->courseModel = new CourseModel();
        $this->enrollmentModel = new EnrollmentModel();  // ✅ UNCOMMENTED
        
        // Auth check - OAuth login
        if (!session()->get('user_id')) {
            return redirect()->to('/oauth/login');  // ✅ Fixed OAuth path
        }
    }

    public function dashboard()
    {
        $userId = session()->get('user_id');
        $user = $this->userModel->find($userId);
        
        if (!$user) {
            return redirect()->to('/')->with('error', 'User session invalid');
        }

        // ✅ Use EnrollmentModel methods
        $stats = $this->enrollmentModel->getUserStats($userId);
        $recentCourses = $this->enrollmentModel->getRecentCourses($userId);

        $data = [
            'page_title' => 'Dashboard',
            'user' => $user,
            'stats' => $stats,
            'recent_courses' => $recentCourses
        ];

        $content = view('pages/user/dashboard', $data);
        return view('templates/layout_inner_home', [
            'pageData' => [
                'title' => 'Dashboard - ' . esc($user['name'] ?? session()->get('user_name')),
                'description' => 'Your learning dashboard',
                'keywords' => 'dashboard, my learning, progress'
            ],
            'content' => $content
        ]);
    }

    public function profile()
    {
        $userId = session()->get('user_id');
        $user = $this->userModel->find($userId);
        
        if (!$user) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        // ✅ Use EnrollmentModel
        $data = [
            'page_title' => 'Profile',
            'user' => $user,
            'enrollments_count' => $this->enrollmentModel->where('user_id', $userId)->countAllResults(),
            'stats' => $this->enrollmentModel->getUserStats($userId)
        ];

        $content = view('pages/user/profile', $data);
        return view('templates/layout_inner_home', [
            'pageData' => [
                'title' => 'Profile - ' . esc($user['name'] ?? session()->get('user_name')),
                'description' => 'Your profile and learning statistics',
                'keywords' => 'profile, account, statistics'
            ],
            'content' => $content
        ]);
    }

    public function myCourses()
    {
        $userId = session()->get('user_id');
        
        // ✅ Use EnrollmentModel method
        $courses = $this->enrollmentModel->getUserCourses($userId);
        $stats = $this->enrollmentModel->getUserStats($userId);

        $data = [
            'page_title' => 'My Courses',
            'courses' => $courses,
            'stats' => $stats,
            'empty_state' => empty($courses)
        ];

        $content = view('pages/user/my_courses', $data);
        return view('templates/layout_inner_home', [
            'pageData' => [
                'title' => 'My Courses',
                'description' => 'Your enrolled courses and progress',
                'keywords' => 'my courses, enrolled courses, learning progress'
            ],
            'content' => $content
        ]);
    }

    public function myQuizzes()
    {
        $userId = session()->get('user_id');
        // TODO: QuizModel integration
        $data = [
            'page_title' => 'My Quizzes',
            'quizzes' => [],  // QuizModel::getUserQuizzes($userId)
            'stats' => $this->enrollmentModel->getUserStats($userId)
        ];

        $content = view('user/my_quizzes', $data);
        return view('templates/layout_inner_home', [
            'pageData' => [
                'title' => 'My Quizzes',
                'description' => 'Your quiz results and scores',
                'keywords' => 'quizzes, results, scores'
            ],
            'content' => $content
        ]);
    }

    /**
     * Enroll in course (AJAX endpoint)
     */
    public function enroll($courseId)
    {
        $userId = session()->get('user_id');
        if (!$userId) {
            return $this->response->setJSON(['success' => false, 'message' => 'Unauthorized']);
        }

        $enrollmentId = $this->enrollmentModel->enrollUser($userId, $courseId);
        if ($enrollmentId) {
            return $this->response->setJSON([
                'success' => true, 
                'message' => 'Enrolled successfully',
                'enrollment_id' => $enrollmentId
            ]);
        }

        return $this->response->setJSON(['success' => false, 'message' => 'Enrollment failed']);
    }

    /**
     * Update course progress (AJAX)
     */
    public function updateProgress($courseId)
    {
        $userId = session()->get('user_id');
        $progress = $this->request->getPost('progress');

        if (!$this->enrollmentModel->updateProgress($userId, $courseId, $progress)) {
            return $this->response->setJSON(['success' => false, 'message' => 'Update failed']);
        }

        return $this->response->setJSON(['success' => true, 'progress' => $progress]);
    }
}