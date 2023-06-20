<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Traits\AuthTrait;
use App\Http\Requests\Frontend\Document\UpdateDocumentRequest;
use App\Http\Requests\Frontend\Document\CreateDocumentRequest;
use App\Services\Shared\Document\DocumentService;
use App\Services\Shared\File\FileServiceInterface;

class DocumentController extends Controller
{

    use AuthTrait;

    private $fileService;
    private $documentService;

    public function __construct(FileServiceInterface  $fileService, DocumentService $documentService)
    {
        $this->fileService = $fileService;
        $this->documentService = $documentService;
    }

    public function index()
    {
        $current_user = $this->getCurrentUser();
        $document = $this->documentService->getByUserId($current_user->id);
        return view('frontend.account.documents.index', ['current_user' => $current_user, 'document' => $document]);
    }

    public function create()
    {
        return view('frontend.account.documents.create');
    }

    public function store(CreateDocumentRequest $request){
        $data = $request->validated();
        try {
            $current_user = $this->getCurrentUser();
            $data['user_id'] = $current_user->id;
            $case_approvals = [];
            if (isset($data['business_license'])) {
                $file = $this->fileService->createData($data['business_license'], 'documents');
                $data['business_license'] = $file['public_path'];
            }
            if (isset($data['rcic_license'])) {
                $file = $this->fileService->createData($data['rcic_license'], 'documents');
                $data['rcic_license'] = $file['public_path'];
            }
            if (isset($data['pmr_course_certificate'])) {
                $file = $this->fileService->createData($data['pmr_course_certificate'], 'documents');
                $data['pmr_course_certificate'] = $file['public_path'];
            }

            if (isset($data['case_approval'])) {
                foreach($data['case_approval'] as $ca){
                    $file = $this->fileService->createData($ca, 'documents');
                    array_push($case_approvals, $file['public_path']);
                }
            }
            if(count($case_approvals) > 0){
                $data['case_approval'] =  json_encode($case_approvals);
            }
            $document = $this->documentService->create($data);
            return redirect()->back()->with('success', 'Documents has been submitted successfully');
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', 'Something went wrong, please try again later.');
        }
    }

    public function edit($id){
        $current_user = $this->getCurrentUser();
        $document = $this->documentService->getById($id);
        return view('frontend.account.documents.edit', ['current_user' => $current_user, 'document' => $document]);
    }

    public function update($id, UpdateDocumentRequest $request)
    {
        $data = $request->validated();
        try {
            $current_user = $this->getCurrentUser();
            $data['user_id'] = $current_user->id;
            $case_approvals = [];
            if (isset($data['business_license'])) {
                $file = $this->fileService->createData($data['business_license'], 'documents');
                $data['business_license'] = $file['public_path'];
            }
            if (isset($data['rcic_license'])) {
                $file = $this->fileService->createData($data['rcic_license'], 'documents');
                $data['rcic_license'] = $file['public_path'];
            }
            if (isset($data['pmr_course_certificate'])) {
                $file = $this->fileService->createData($data['pmr_course_certificate'], 'documents');
                $data['pmr_course_certificate'] = $file['public_path'];
            }
            if (isset($data['case_approval'])) {
                foreach($data['case_approval'] as $ca){
                    $file = $this->fileService->createData($ca, 'documents');
                    array_push($case_approvals, $file['public_path']);
                }
            }
            if(count($case_approvals) > 0){
                $data['case_approval'] =  json_encode($case_approvals);
            }
            $document = $this->documentService->update($id, $data);
            return redirect()->back()->with('success', 'Documents has been submitted successfully');
        } catch (\Exception $exception) {
            dd($exception);
            return redirect()->back()->with('error', 'Something went wrong, please try again later.');
        }
    }


}
