<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\AuthTrait;
use App\Services\Shared\Plan\PlanService;
use App\Http\Requests\Backend\Plan\UpdateFeatureRequest;

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
        return view("backend.billing.index", compact("plans"));
    }

    public function show($id)
    {
        $plan = $this->planService->getById($id);
        return view("backend.billing.show", compact("plan"));
    }

    public function editFeature($plan_id, $feature_id)
    {
        $feature = $this->planService->getFeatureById($feature_id);
        return view("backend.billing.feature.edit", compact("feature", "plan_id"));
    }

    public function updateFeature($plan_id, $feature_id, UpdateFeatureRequest $request)
    {
        $data = $request->validated();
        try {
            $this->planService->updateFeature($feature_id, $data);
            return redirect()->back()->with('success', 'Feature has been updated successfully');
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', 'Something went wrong, please try again later.');
        }
    }

    public function deleteFeature($id)
    {
        try {
            $feature = $this->planService->deleteFeature($id);
            return $this->sendResponse('success', 'Feature has been deleted successfully', $feature, 200);
        } catch (\Exception $exception) {
            return $this->sendResponse('error', "Something Went wrong, please try again later", null, 400);
        }
    }
}
