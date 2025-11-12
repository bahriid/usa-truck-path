<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use DB;
use Illuminate\Http\Request;

class AdminEnrollmentController extends Controller
{
    public function index(Request $request)
    {
        $query = DB::table('course_user')
            ->join('courses', 'course_user.course_id', '=', 'courses.id')
            ->join('users', 'course_user.user_id', '=', 'users.id')
            ->select(
                'course_user.*',
                'courses.title as course_title',
                'users.id as user_id',
                'users.name as user_name',
                'users.email as email',
                'course_user.phone as phone',
                'course_user.subscription_tier as tier',
                'course_user.status as status'
            );
    
            // dd($query);
        // Apply search if keyword exists
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('users.name', 'LIKE', "%{$search}%")
                  ->orWhere('users.email', 'LIKE', "%{$search}%")
                  ->orWhere('course_user.phone', 'LIKE', "%{$search}%")
                  ->orWhere('courses.title', 'LIKE', "%{$search}%");
            });
        }
    
        // Apply filter by status
        if ($request->has('status') && $request->status != '') {
            $query->where('course_user.status', $request->status);
        }

        // Apply filter by tier
        if ($request->has('tier') && $request->tier != '') {
            $query->where('course_user.subscription_tier', $request->tier);
        }

        // Get paginated results - sorted by latest first
        $enrollments = $query->orderBy('course_user.created_at', 'desc')->paginate(10);

        return view('admin.enrollment.index', compact('enrollments'));
    }

    public function export(Request $request)
    {
        $query = DB::table('course_user')
            ->join('courses', 'course_user.course_id', '=', 'courses.id')
            ->join('users', 'course_user.user_id', '=', 'users.id')
            ->select(
                'users.name as user_name',
                'users.email as email',
                'course_user.phone as phone',
                'course_user.country as country',
                'courses.title as course_title',
                'course_user.subscription_tier as tier',
                'course_user.status as status',
                'course_user.transaction_amount as amount',
                'course_user.transaction_id as transaction_id',
                'course_user.created_at as enrolled_at'
            );

        // Apply same filters as index
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('users.name', 'LIKE', "%{$search}%")
                  ->orWhere('users.email', 'LIKE', "%{$search}%")
                  ->orWhere('course_user.phone', 'LIKE', "%{$search}%")
                  ->orWhere('courses.title', 'LIKE', "%{$search}%");
            });
        }

        if ($request->has('status') && $request->status != '') {
            $query->where('course_user.status', $request->status);
        }

        if ($request->has('tier') && $request->tier != '') {
            $query->where('course_user.subscription_tier', $request->tier);
        }

        $enrollments = $query->orderBy('course_user.created_at', 'desc')->get();

        // Create CSV
        $filename = 'enrollments_' . date('Y-m-d_His') . '.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function() use ($enrollments) {
            $file = fopen('php://output', 'w');

            // Add CSV headers
            fputcsv($file, [
                'Full Name',
                'Email',
                'Phone',
                'Course',
                'Tier',
                'Date',
                'Status',
                'Country',
                'Amount',
                'Transaction ID'
            ]);

            // Add data rows
            foreach ($enrollments as $enrollment) {
                fputcsv($file, [
                    $enrollment->user_name,
                    $enrollment->email,
                    $enrollment->phone,
                    $enrollment->course_title,
                    ucfirst($enrollment->tier),
                    \Carbon\Carbon::parse($enrollment->enrolled_at)->format('M d, Y'),
                    ucfirst($enrollment->status),
                    $enrollment->country,
                    $enrollment->amount ? '$' . number_format($enrollment->amount, 2) : 'N/A',
                    $enrollment->transaction_id
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
    
    public function transactions(Request $request)
    {
        $query = DB::table('course_user')
            ->join('courses', 'course_user.course_id', '=', 'courses.id')
            ->join('users', 'course_user.user_id', '=', 'users.id')
            ->select(
                'course_user.*',
                'courses.title as course_title',
                'courses.price as course_price',
                'users.name as user_name',
                'users.email as user_email',
                'course_user.subscription_tier as tier',
                'course_user.status as status'
            );

        // Apply search if keyword exists
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('users.name', 'LIKE', "%{$search}%")
                    ->orWhere('users.email', 'LIKE', "%{$search}%")
                    ->orWhere('courses.title', 'LIKE', "%{$search}%")
                    ->orWhere('course_user.transaction_id', 'LIKE', "%{$search}%"); // Search by transaction ID as well
            });
        }

        // $transactions = $query->orderBy('course_user.created_at', 'desc')->paginate(10);
        $transactions = $query->orderBy('course_user.created_at', 'desc')
        ->paginate(10)
        ->through(function ($transaction) {
            $transaction->created_at = \Carbon\Carbon::parse($transaction->created_at);
            return $transaction;
        });

        // dd($transactions);

        return view('admin.enrollment.transaction', compact('transactions'));
    }

    ///delte the user

    public function destroyUser(Request $request,User $user){
        // dd($user);
        $user->delete();
        //  return response()->json(['success'=>'User Deleted Successfully'], 200 );
         return redirect()->back()->with('success','User Deleted Successfully');

    }
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,approved,rejected',
        ]);
    
        DB::table('course_user')->where('id', $id)->update(['status' => $request->status]);
    
        return redirect()->back()->with('success', 'Enrollment status updated successfully!');
    }
}
