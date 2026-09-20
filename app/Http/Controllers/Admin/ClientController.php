<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\WelcomeClientMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class ClientController extends Controller
{
    public function create()
    {
        $clients = User::where('role', 'client')->latest()->get();

        return view('admin.create-client', compact('clients'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
        ]);

                $client = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'client',
        ]);

        Mail::to($client->email)->send(new WelcomeClientMail($client));

        return redirect()->route('admin.clients.create')
            ->with('success', 'Client account created successfully.');
    }
    }