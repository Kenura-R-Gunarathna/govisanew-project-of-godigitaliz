<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\AuthTrait;
use Illuminate\Support\Facades\Log;
use App\Services\Shared\Plan\PlanService;
use App\Models\Subscription;
use App\Mail\SubscribeCanceled;
use Illuminate\Support\Facades\Mail;

class BillingController extends Controller
{

    use AuthTrait;

    public $planService;

    public function __construct(PlanService $planService)
    {
        $this->planService = $planService;
    }

    public function index()
    {
        $plans = $this->planService->getAll();
        $current_user = $this->getCurrentUser();
        $active_subscription = $current_user->subscriptions()->active()->first();
        return view("frontend.account.billing.index", compact("plans", "current_user", "active_subscription"));
    }

    public function show($id)
    {
        $plan = $this->planService->getById($id);
        $intent = auth()->user()->createSetupIntent();
        return view("frontend.account.billing.show", compact("plan", "intent"));
    }

    public function create(Request $request)
    {
        $plan = $this->planService->getById($request->plan);
        if ($plan) {
            try {
                $paymentMethod = $request->token;
                $current_user = $this->getCurrentUser();
                $current_user->createOrGetStripeCustomer();
                if (!$current_user->hasPaymentMethod()) {
                    $current_user->addPaymentMethod($paymentMethod);
                }
                $subscription = Subscription::query()->active()->where('user_id', $current_user->id)->first();
                if (isset($subscription)) {
                    $current_user->subscription('default')->swapAndInvoice($plan->stripe_plan);
                } else {
                    $current_user->newSubscription('default', $plan->stripe_plan)->create($paymentMethod, [
                        'email' => $current_user->email
                    ]);
                }
                return redirect()->route('account.billing')->with('success', 'Your payment was successfull.');
            } catch (\Exception $e) {
                Log::error($e);
                return redirect()->back()->with('error', 'Something went wrong, please try again later.');
            }
        } else {
            return redirect()->back()->with('error', 'Something went wrong, please try again later.');
        }
    }

    public function cancel($id)
    {
        $current_user = $this->getCurrentUser();
        try {
            $plan = $this->planService->getById($id);
            $subscription = Subscription::query()->active()->where([['stripe_price', '=', $plan->stripe_plan], ['user_id', '=', $current_user->id]])->first();
            $subscription->cancelNow();
            Mail::to($current_user)->send(new SubscribeCanceled($plan));
            return redirect()->route('account.billing')->with('success', 'Your subscription has been cancelled!');
        } catch (\Exception $e) {
            Log::error($e);
            return redirect()->back()->with('error', 'Something went wrong, please try again later.');
        }
    }
}
