<?php

namespace App\Http\Controllers;

use Dompdf\Dompdf;
use Dompdf\Options;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UsersExport;
use Illuminate\Support\Facades\Hash; // Import Hash facade
class UserController extends Controller
{
    public function index()
    {
        $users = User::all(); // Fetch all users from the database
        return view('users.index', compact('users')); // Pass the $users variable to the view
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

     public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'city' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'age' => 'required|integer|min:18',
        ]);

        // Update user details
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'city' => $request->city,
            'description' => $request->description,
            'age' => $request->age,
        ]);

        // Update password if old password is provided and matches current password
        if ($request->filled('old_password') && Hash::check($request->old_password, $user->password)) {
            $user->update([
                'password' => Hash::make($request->new_password),
            ]);
        }

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully');
    }

    //pdf function
    public function downloadPDF()
    {
        $users = User::all();
        $dompdf = new Dompdf();
        $dompdf->loadHtml(view('users.pdf', compact('users'))->render());
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        return $dompdf->stream('user-list.pdf');
    }

    public function exportExcel()
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }
}
