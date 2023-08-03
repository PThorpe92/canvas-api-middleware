<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CanvasController extends Controller
{
    /**
     * Get a list of users from Canvas
     *
     * @return void
     */

    public function getUsers()
    {
        $canvasApi = env('CANVAS_API');
        $canvasApiKey = env('CANVAS_API_KEY');

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $canvasApiKey,
        ])->get($canvasApi . 'accounts/self/users');

        $users = $response->json();
        if ($response->failed()) {
            $error = $response->json();
            return redirect()->route('canvas-users')->with('error', $error['errors'][0]['message']);
        } else {
            $users = $response->json();
            echo print_r($users);
            return view('users', ['users' => $users]);
        }
    }
    /**
     * Create a new user in Canvas
     *
     * @param Request $request
     * @return void
     *
     * Self-registration is deprecated in Canvas, so this method is just for demonstration purposes
     */

    public function createUser(Request $request)
    {
        $name = $request->input('name');
        $email = $request->input('email');

        $userData = [
            'name' => $name,
            'email' => $email,
            // Add other data needed to create a user in the Canvas API
        ];

        $canvasApi = env('CANVAS_API');
        $canvasApiKey = env('CANVAS_API_KEY');

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $canvasApiKey,
        ])->post($canvasApi . "accounts/self/users/", $userData);

        // Add debug log to check the response
        \Log::info($response->body());

        if ($response->successful()) {
            $newUser = $response->json();
            $users = $this->getUsers(); // Get the list of users again after adding the new user
            return view('users', ['users' => $users, 'newUser' => $newUser]);
        } else {
            $error = $response->json();
            return redirect()->route('canvas-users')->with('error', $error['errors'][0]['message']);
        }
    }
}
