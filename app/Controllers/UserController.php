<?php
namespace App\Controllers;

use App\Models\UserModel;
use App\Models\VehicleOwnershipModel;
use App\Models\WishlistModel;
use App\Models\ComparisonModel;
use CodeIgniter\Controller;

class UserController extends Controller
{
    protected $userModel;
    protected $ownershipModel;
    protected $wishlistModel;
    protected $comparisonModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->ownershipModel = new VehicleOwnershipModel();
        $this->wishlistModel = new WishlistModel();
        $this->comparisonModel = new ComparisonModel();

        if (!session()->get('user_id')) {
            return redirect()->to('/oauth/login');
        }
    }

    public function dashboard()
    {
        $userId = session()->get('user_id');
        $user = $this->userModel->find($userId);

        if (!$user) {
            return redirect()->to('/')->with('error', 'User session invalid');
        }

        $stats = [
            'total_vehicles' => $this->ownershipModel->countAllResults(),
            'owned_vehicles' => $this->ownershipModel->where('user_id', $userId)->countAllResults(),
            'wishlist_count' => $this->wishlistModel->where('user_id', $userId)->countAllResults(),
            'comparison_count' => $this->comparisonModel->where('user_id', $userId)->countAllResults()
        ];

        $recentVehicles = $this->ownershipModel->getOwnedVehicles($userId);

        $data = [
            'page_title' => 'Dashboard',
            'user' => $user,
            'stats' => $stats,
            'recent_vehicles' => $recentVehicles
        ];

        return view('templates/layout_inner_home', [
            'pageData' => [
                'title' => 'Dashboard - ' . esc($user['name'] ?? session()->get('user_name')),
                'description' => 'Your automotive dashboard with stats and recent activity',
                'keywords' => 'dashboard, cars, vehicles, garage, wishlist'
            ],
            'content' => view('pages/user/mydashboard', $data)
        ]);
    }

    /**
     * Profile page
     */
    public function profile()
    {
        $userId = session()->get('user_id');
        $user = $this->userModel->find($userId);

        if (!$user) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $data = [
            'page_title' => 'Profile',
            'user' => $user,
            'owned_vehicles' => $this->ownershipModel->where('user_id', $userId)->countAllResults(),
            'wishlist_count' => $this->wishlistModel->where('user_id', $userId)->countAllResults(),
            'comparison_count' => $this->comparisonModel->where('user_id', $userId)->countAllResults()
        ];

        return view('templates/layout_inner_home', [
            'pageData' => [
                'title' => 'Profile - ' . esc($user['name'] ?? session()->get('user_name')),
                'description' => 'Your profile and automotive statistics',
                'keywords' => 'profile, account, cars, wishlist, comparisons'
            ],
            'content' => view('pages/user/profile', $data)
        ]);
    }
    public function favorites()
    {
        $userId = session()->get('user_id');
        if (!$userId) {
            return redirect()->to('/oauth/login');
        }

        // Fetch favorites from a model
        $favorites = $this->wishlistModel->where('user_id', $userId)
            ->join('vehicles', 'vehicles.vehicle_id = wishlist.vehicle_id')
            ->findAll();

        $data = [
            'page_title' => 'My Favorites',
            'favorites' => $favorites
        ];

        return view('templates/layout_inner_home', [
            'pageData' => [
                'title' => 'Favorites - ' . esc(session()->get('user_name')),
                'description' => 'Your favorite cars list',
                'keywords' => 'favorites, wishlist, cars'
            ],
            'content' => view('pages/user/favorites', $data)
        ]);
    }

}
