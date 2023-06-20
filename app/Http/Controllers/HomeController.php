<?php

namespace App\Http\Controllers;

use App\Models\BookingTimeSlot;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Services\Frontend\Account\AccountService;
use App\Services\Shared\Location\LocationService;
use App\Services\Shared\Review\ReviewService;
use App\Services\Shared\Booking\BookingService;
use App\Services\Frontend\Analytic\AnalyticService;
use App\Http\Requests\Frontend\Review\CreateReviewRequest;
use App\Http\Requests\Frontend\Contact\CreateContactRequest;
use Illuminate\Support\Facades\Mail;
use App\Mail\BookingCreated;
use App\Mail\ContactMessage;
use Illuminate\Support\Facades\Auth;
use Google\Service\ServiceControl\Auth as ServiceControlAuth;

class HomeController extends Controller
{
    private $accountService;
    private $locationService;
    private $bookingService;

    public function __construct(AccountService $accountService, LocationService $locationService, BookingService $bookingService)
    {
        $this->accountService = $accountService;
        $this->locationService = $locationService;
        $this->bookingService = $bookingService;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $mostRecommendedProviders = $this->accountService->getMostRecommendedProviders();
        $mostRecommendedProviders2 = $this->accountService->getProvidersByLocation('Surrey');
        $mostRecommendedProviders3 = $this->accountService->getProvidersByLocation('Vancouver');
        $popularLocations = $this->locationService->getPopularLocations();

        $data = compact('mostRecommendedProviders', 'mostRecommendedProviders2', 'mostRecommendedProviders3', 'popularLocations');
        return view('frontend.guest.home')->with($data);
    }



    /**
     * Display the search results page with a list of users matching the search query.
     * @param Request $request
     * @return View
     */
    public function getSearch(Request $request)
    {
        $data = $request->all();
        $providers = $this->accountService->getSearch($data);
        $locations = $this->locationService->getAll();
        return view('frontend.guest.search', ['locations' => $locations, 'providers' => $providers]);
    }


    /**
     * Display the profile view for a given user based on their slug.
     * @param $slug|string
     * @return View
     */
    public function getProfile($slug, ReviewService $reviewService, AnalyticService $analyticService)
    {
        $has_reviewed = false;
        $provider = $this->accountService->getUserBySlug($slug);
        $relevantProviders = $this->accountService->getRelevantProvidersByLocation($provider->profile->location_id);
        $reviews = $reviewService->getByProvider($provider->id);
        if (Auth::check()) {
            if ($provider->id != auth()->user()->id) {
                $analyticService->track($provider->id, auth()->user()->id);
                $hasReviewed = $reviewService->hasReviewed($provider->id, auth()->user()->id);
                if ($hasReviewed) {
                    $has_reviewed = true;
                }
            }
        }

        return view('frontend.guest.profile', ['account' => $provider, 'relevantProviders' => $relevantProviders, 'reviews' => $reviews, 'has_reviewed' => $has_reviewed]);
    }

    public function getByCategory(Request $request, $category)
    {
        $providers = $this->accountService->getProvidersByCategory($category);
        $locations = $this->locationService->getAll();
        $slug = $this->accountService->categoryFormat($category);
        return view('frontend.guest.category', ['providers' => $providers, 'slug' => $slug, 'locations' => $locations]);
    }

    public function getContactUsPage()
    {
        return view('frontend.guest.contact');
    }

    public function getPrivacyPage()
    {
        return view('frontend.guest.privacy');
    }

    public function getTermsOfServicePage()
    {
        return view('frontend.guest.terms-of-service');
    }

    public function getAboutUsPage()
    {
        return view('frontend.guest.about-us');
    }


    public function getFaqPage()
    {
        return view('frontend.guest.faq');
    }

    public function getAvailableTimeSlotsByDay(Request $request): array
    {
        return $this->bookingService->getAvailableTimeSlotsByDay($request['agent_id'], $request['date']);
    }

    public function createReview(CreateReviewRequest $request, ReviewService $reviewService)
    {
        $data = $request->validated();
        try {
            $data['user_id'] =  auth()->user()->id;
            $review = $reviewService->create($data);
            return $this->sendResponse('success', 'Review has been created successfully', $review, 200);
        } catch (\Exception $exception) {
            return $this->sendResponse('error', 'Something went wrong, please try again later.', null, 400);
        }
    }


    public function getSearchSuggestions(Request $request)
    {

        $data = [];

        $query = $request->all();

        if ($request->filled('q')) {
            $data = $this->accountService->getSearchSuggestions($query);
        }

        return response()->json($data);
    }

    public function confirmBooking(Request $request): RedirectResponse
    {
        $booking = $this->bookingService->confirmBooking($request->all());
        if (isset($booking)) {
            //Mail::to($booking->agent)->send(new BookingCreated($booking));
            return redirect()->back()->with('success', 'Booking has been created successfully.');
        } else {
            return redirect()->back()->with('error', 'Something went wrong, please try again later.');
        }
    }

    public function sendContactMessage(CreateContactRequest $request)
    {
        $data = $request->validated();
        try {
            Mail::to(config('mail.notifier'))->send(new ContactMessage($data));
            return redirect()->back()->with('success', 'Thank you for your inquiry, we will get back to you as soon as possible');
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', 'Something went wrong, please try again later.');
        }
    }
}
