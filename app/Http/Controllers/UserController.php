<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function welcome()
    {
        // Check if the user is authenticated
        if (!auth()->check()) {
            // User is not logged in
            // Show view for guests
            return "You are not logged in";
        }

        // Check the authenticated user's role
        // Show view for admin
        $role = auth()->user()->role;

        if ($role === 'admin') {
            // User is an admin
            return "Logged in as admin";
        } else {
            // User is a regular user
            // Show view for regular user
           return "Logged In as user";
        }
    }

    public function admin(){
        return "Admin home.";
      }

      public function user(){
        return "User home.";
      }



    public function profile()
    {
        if (!auth()->check()) {
            // Redirect to login if not authenticated
            return redirect()->route('login');
        }

        $role = auth()->user()->role;

        // Check if the user is already on their correct profile to avoid infinite redirects

        if ($role === 'admin' && request()->routeIs('admin')) {
            // Render admin profile view
            return "Admin profile";
        }

        if ($role === 'user' && request()->routeIs('user')) {
            // Render user profile view
            return "Regular user profile";
        }

        // Redirect to the correct profile
        if ($role === 'admin') {
            return redirect()->route('admin');
        } else {
            return redirect()->route('user');
        }

    }
}
