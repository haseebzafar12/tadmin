<?php
namespace App\Http\Controllers;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->get();
        return view('admin.users.index', compact('users'));
    }
    public function create()
    {
        $roles = Role::all();
        return view('admin.users.create', compact('roles'));
    }
    public function store(Request $request)
    {
        // Validate user input, including roles
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'roles' => 'array|required',
            'roles.*' => 'exists:roles,id',  // Ensures roles are valid
        ]);

        // Create the user
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')), // Hash the password before storing
        ]);

        // Assign roles to the user
        $user->roles()->sync($request->input('roles'));

        // Return success response
        return response()->json([
            'success' => true,
            'message' => 'User created successfully and roles assigned.',
        ]);
    }
    public function show(){
        echo "Ok";
    }
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
        return view('users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->syncRoles($request->roles);
        return redirect()->route('users.index');
    }
}
