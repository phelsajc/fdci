<?php

namespace App\Http\Controllers;
use App\Models\Contacts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use DB;

class ContactsController extends Controller
{
    public function index()
    {
        $contacts = Contacts::where('created_by', auth()->id())->paginate(10);
        return view('contacts.index', ['contacts' => $contacts]);
    }

    public function show(Contacts $user)
    {
        return view('contacts.show', compact('user'));
    }

    public function create()
    {
        return view('contacts.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'company' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
        ]);

        Contacts::create([
            'name' => $validatedData['name'],
            'company' => $validatedData['company'],
            'phone' => $validatedData['phone'],
            'email' => $validatedData['email'],
            'created_by' => auth()->id(),
            'created_at' => now()
        ]);

        return redirect()->route('contacts.index')->with('success', 'Contacts created successfully.');
    }

    public function edit(Contacts $contacts)
    {
        return view('contacts.edit', compact('contacts'));
    }

    /**
     * Summary of update
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $user
     * @return mixed
     * Note:
     * Ensures that the email is unique in the users table, 
     * but excludes the current user's email (whose ID is $user->id) from this uniqueness check.
     */
    public function update(Request $request, Contacts $contacts)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'company' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
        ]);

        $contacts->update($validatedData);

        return redirect()->route('contacts.index')->with('success', 'Contact updated successfully.');
    }

    public function destroy(Contacts $contacts)
    {
        $contacts->delete();
        return redirect()->route('contacts.index')->with('success', 'Contact deleted successfully.');
    }

    public function search(Request $request)
    {
        $search = $request->input('query');
        $userid = auth()->id();
        //   $contacts =  DB::connection('mysql')->select("SELECT * from contacts where created_by = $userid AND (name like '%$search%' or  company like '%$search%' or phone like '%$search%' or email like '%$search%')");
        $contacts = Contacts::where('created_by', auth()->id())
            ->where(function ($query) use ($search) {
                if ($search) {
                    $query->where('name', 'LIKE', "%$search%")
                        ->orWhere('company', 'LIKE', "%$search%")
                        ->orWhere('phone', 'LIKE', "%$search%")
                        ->orWhere('email', 'LIKE', "%$search%");
                }
            })
            ->paginate(10);
        return response()->json($contacts);
    }
}
