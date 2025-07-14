<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Mail\ForgotPassword;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Mail;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all(); // Retrieve all users from the database
        if ($users->isNotEmpty()) {
            return response()->json(['users' => $users]);
        } else {
            return response()->json([], 204);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'mobile_number' => 'required|string|max:15',
            'password' => 'required|string|min:6',
        ]);

        $validated['password'] = bcrypt($validated['password']);

        $user = User::create($validated);

        return $user;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'mobile_number' => 'required|string|max:15',
            'password' => 'required|string|min:6',
        ]);

        $validated['password'] = bcrypt($validated['password']);

        $user = User::create($validated);

        return response()->json(['user' => $user], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::find($id);

        if ($user) {
            return response()->json(['user' => $user], 200);
        } else {
            return response()->json(['message' => 'User not found'], 404);

        }
    }

    public function forgotPassword(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
        ]);

        $user = User::where('email', $validated['email'])->first();

        if (!$user) {
            return response()->json(['message' => 'Email not found'], 404);
        }

        if ($user) {
            $user_token = Crypt::encryptString($user->id); //token generation
            $user->user_token = $user_token;
            $user->save();
            Mail::to($user->email)->send(new ForgotPassword(['token' => $user_token]));
            return response()->json(['message' => 'Password reset link sent to your email'], 200);
        } else {
            return response()->json(['message' => 'Email not found'], 404);
        }
    }

    public function resetPassword(Request $request)
    {
        $userid = Crypt::decryptString($request->user_token);
        $user = User::find($userid);

        if (!$user || $user == null) {
            return response()->json(['success' => false]);
        }

        $confirmPass = $request->confirm_password;
        $password = $request->password;

        if ($confirmPass === $password) {
            $user->password = Hash::make($password);
            $user->save();
            return response()->json(data: ['success' => true]);
        }else {
            return response()->json(['success' => false, 'message' => 'Passwords do not match']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email|unique:users,email,',
            'mobile_number' => 'sometimes|required|string|max:15',
            'password' => 'sometimes|required|string|min:6',
        ]);
        $user = User::find($id);
        $user->update($validated);
        return response()->json(['user' => $user], 200);
    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        $user = User::where('email', $validated['email'])->first();



        //make session here?

        return response()->json(['user' => $user], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
        $user->delete();
        return response()->json([], 200);
    }
}
