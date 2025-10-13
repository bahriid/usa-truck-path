<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    // Display a paginated list of all users
    // public function index(){
    //     $users = User::paginate(1);
    //     return view('admin.users.index', compact('users'));
    // }
    public function index(Request $request){
        $query = User::query();
    
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }
    
        // Adjust pagination as needed, here I use 10 per page
        $users = $query->paginate(10)->appends($request->only('search'));
    
        return view('admin.users.index', compact('users'));
    }

    // Show the details for a single user, including the courses they've purchased
    public function show($id) {
        $user = User::findOrFail($id);
        // Assuming your User model has a purchasedCourses() relationship
        $courses = $user->purchasedCourses()->paginate(10);
        return view('admin.users.show', compact('user', 'courses'));
    }

    // Show the form for changing a user's password
    public function editPassword($id) {
        $user = User::findOrFail($id);
        return view('admin.users.change-password', compact('user'));
    }

    // Update the user's password
    public function updatePassword(Request $request, $id) {
        $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::findOrFail($id);
        $user->password = Hash::make($request->password);
        
        $user->save();

        return redirect()->route('admin.users.show', $user->id)
            ->with('success', 'Password updated successfully!');
    }
}
