<?php

namespace App\Http\Controllers;
use App\Http\Requests\SubjectRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Service\SubjectServiceController;
use App\Models\Subject;

class SubjectController extends Controller
{
    protected $subjectService;

    public function __construct(SubjectServiceController $subjectService)
    {
        $this->subjectService = $subjectService;
    }

    public function index()
    {
        $subjects = $this->subjectService->getAllSubjects();
        return view('subjects.index', compact('subjects'));
    }

    public function create()
    {
        return view('subjects.create');
    }

    public function store(SubjectRequest $request)
    {
    

        Subject::create($request->except('_token')); // ✅ Exclude `_token`
    return redirect()->route('subjects.index')->with('success', 'Subject created successfully');
    }

    public function edit($id)
    {
        $subject = $this->subjectService->getSubjectById($id);
        return view('subjects.edit', compact('subject'));
    }

    public function update(Request $request, $id)
    {
        $subject = Subject::findOrFail($id);
    
        // Exclude '_token' and '_method' before updating
        $subject->update($request->except(['_token', '_method']));
    
        return redirect()->route('subjects.index')->with('success', 'Subject updated successfully!');
    }

    public function destroy($id)
    {
        $this->subjectService->deleteSubject($id);
        return redirect()->route('subjects.index')->with('success', 'Subject deleted successfully!');
    }
}


