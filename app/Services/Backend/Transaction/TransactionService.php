<?php

namespace App\Services\Backend\Transaction;

use App\Models\Subscription;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class TransactionService
{
    public function getAll()
    {
        return Subscription::all();
    }

    public function getById($id)
    {
        return Subscription::find($id);
    }

    public function update($id, $data)
    {
        $transaction = $this->getById($id);
        $transaction->update($data);
        return  $transaction;
    }

    public function delete($id)
    {
        $transaction = $this->getById($id);
        return $transaction->delete();
    }
}
