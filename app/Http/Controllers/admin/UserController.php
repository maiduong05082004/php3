<?php
namespace App\Http\Controllers\admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('status', '<>', 3)->where('id', '<>', 0)->orderBy('id', 'desc')->get();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'address' => 'required|string|max:255',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $data = $request->all();
        $data['password'] = Hash::make($data['password']);
        $data['status'] = 1;

        User::create($data);
        return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'address' => 'required|string|max:255',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $data = $request->all();
        if ($request->filled('password')) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $user->update($data);
        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }

    public function softDestroy($id)
    {
        $user = User::findOrFail($id);
        $user->update(['status' => 3]);
        return redirect()->route('admin.users.index')->with('success', 'User moved to trash successfully.');
    }

    public function trash()
    {
        $users = User::where('status', 3)->get();
        return view('admin.users.trash', compact('users'));
    }

    public function restore($id)
    {
        $user = User::findOrFail($id);
        $user->update(['status' => 1]);
        return redirect()->route('admin.users.trash')->with('success', 'User restored successfully.');
    }

    public function forceDelete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users.trash')->with('success', 'User permanently deleted successfully.');
    }
}
