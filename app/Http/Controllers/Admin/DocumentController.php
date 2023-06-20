<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Traits\AuthTrait;
use App\Services\Shared\Document\DocumentService;
use App\Http\Requests\Backend\Document\UpdateDocumentRequest;

class DocumentController extends Controller
{

    use AuthTrait;

    private $documentService;

    public function __construct(DocumentService $documentService)
    {
        $this->documentService = $documentService;
    }

    public function index()
    {
        $current_user = $this->getCurrentUser();
        $documents = $this->documentService->getAll();
        return view('backend.documents.index', ['current_user' => $current_user, 'documents' => $documents]);
    }

    public function edit($id){
        $document = $this->documentService->getById($id);
        return view('backend.documents.edit', ['document' => $document]);
    }

    public function update($id, UpdateDocumentRequest $request){
        $data = $request->validated();
        try {
            $this->documentService->updateSimple($id, $data);
            return redirect()->back()->with('success', 'Document has been updated successfully');
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', 'Something went wrong, please try again later.');
        }
    }

    public function delete($id){ 
        try {
            $document = $this->documentService->delete($id);
            return $this->sendResponse('success', 'Document has been deleted successfully', $document, 200);
        } catch (\Exception $exception) {
            return $this->sendResponse('error', "Something Went wrong, please try again later", null, 400);
        }
    }
}
