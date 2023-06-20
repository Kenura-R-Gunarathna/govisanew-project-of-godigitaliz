<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Traits\AuthTrait;
use App\Services\Backend\Account\AccountService;

class DashboardController extends Controller
{

    use AuthTrait;

    private $accountService;

    public function __construct(AccountService $accountService)
    {
        $this->accountService = $accountService;
    }

    public function index()
    {
        $current_user = $this->getCurrentUser();
        $new_user_count = $this->accountService->getDailyNewUsers();
        return view('backend.dashboard.index', ['current_user' => $current_user, 'new_user_count' => $new_user_count]);
    }
}
