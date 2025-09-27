<?php

// app/Http/Controllers/TeacherRequestController.php
// app/Http/Controllers/TeacherRequestController.php
namespace App\Http\Controllers;

use App\Models\TeacherRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherRequestController extends Controller
{
    // User teacher bo‘lishga ariza beradi
    public function store(Request $request)
    {
        TeacherRequest::create([
            'user_id' => Auth::id(),
            'reason' => $request->reason,
        ]);

        return redirect()->back()->with('success', 'Sorovingiz yuborildi!');
    }

    // Admin barcha sorovlarni ko‘radi
    public function index()
    {
        $requests = TeacherRequest::with('user')->latest()->get();

        return view('admin.teacher_requests.index', compact('requests'));
    }

    // Admin tasdiqlaydi
    public function approve($id)
    {
        $request = TeacherRequest::findOrFail($id);
        $request->update(['status' => 'approved']);

        $request->user->update(['role' => 'teacher']);

        return back()->with('success', 'Teacher sorovi tasdiqlandi!');
    }

    // Admin rad qiladi
    public function reject($id)
    {
        $request = TeacherRequest::findOrFail($id);
        $request->update(['status' => 'rejected']);

        return back()->with('error', 'Teacher sorovi rad qilindi!');
    }
}

