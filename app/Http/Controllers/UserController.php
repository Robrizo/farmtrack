<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
    public function index()
    {
        $users = User::paginate(5);
        return response()->json(['users' => $users]);
    }

    public function search($keyword)
    {
        $users = User::where('name', 'like', "%$keyword%")->paginate(5);
        return response()->json(['users' => $users]);
    }

    public function destroy($id)
    {
        $users = User::findOrFail($id);
        $users->delete();

        return response()->json(['message' => 'user deleted successfully']);
    }

    public function update(Request $request, $id)
    {
        $users = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
        ]);

        $users->update($request->all());

        return response()->json(['message' => 'user updated successfully', 'users' => $users]);
    }
}
