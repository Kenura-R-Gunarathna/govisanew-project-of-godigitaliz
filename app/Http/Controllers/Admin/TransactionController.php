<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Traits\AuthTrait;
use App\Services\Backend\Transaction\TransactionService;

class TransactionController extends Controller
{

    use AuthTrait;
    
    private $transactionService;

    public function __construct(TransactionService $transactionService)
    {
        $this->transactionService = $transactionService;
    }

    public function index()
    {
        $transactions = $this->transactionService->getAll();
        return view('backend.transactions.index', ['transactions' => $transactions]);
    }
}
