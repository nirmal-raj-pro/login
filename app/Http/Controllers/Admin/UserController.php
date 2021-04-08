<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{


    /**
        * Display a listing of the resource.
        *
        * @return Response
        */
    public function index()
    {
        // get all the users (app/views/admin/users/index.blade.php)
        $users = User::latest()->paginate(10);

        // load the view and pass the users
        return view('admin.users.index', compact('users'))
        ->with('i', (request()->input('page', 1) - 1) * 5);

    }


    

    /**
        * Show the form for creating a new resource.
        *
        * @return Response
        */

    public function create()
    {
        // load the create form (app/views/admin/users/create.blade.php)
        return view('admin.users.create');
    }

    


    /**
        * Store a newly created resource in storage.
        *
        * @return Response
        */
    public function store(Request $request)
    {
         
        // validate through method like function
        $this->validateUserCreate($request);

        
        // store
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);
        
        // redirect 
        return redirect()->route('users.index')
            ->with('success', 'User created successfully!');

    }

    

    /**
        * Display the specified resource.
        *
        * @param  int  $id
        * @return Response
        */
    public function show(User $user)
    {        
        // show the view and pass the user to it
        return view('admin.users.show', compact('user'));
    }

    

    /**
        * Show the form for editing the specified resource.
        *
        * @param  int  $id
        * @return Response
        */
    public function edit(User $user)
    {
        // show the edit form and pass the user
        return view('admin.users.edit', compact('user'));
    }




    /**
        * Update the specified resource in storage.
        *
        * @param  int  $id
        * @return Response
        */
    public function update(Request $request, $id)
    {
    
         // validate through method like function
        //  $this->validateUserCreate($request);

         // update
         $user = User::find($id);
         $user->update([
            'name' => $request->name,
            'password' => Hash::make($request->password),
            'role' => $request->role,
         ]);
 
         // redirect 
         return redirect()->route('users.index')
            ->with('success', 'Project updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(user $user)
    {
        $user->delete();

        return redirect()->route('users.index')
            ->with('success', 'User deleted successfully');
    }



    /**
        * Method like function for validate user create request.
        *
        * @param  int  $id
        * @return Response
        */
    public function validateUserCreate(Request $request)
    {
        $messages = [
            'email.unique' => 'Email has been taken already!',  
        ];

        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email,except,id',
            'password' => 'required',
            'role' => 'required',
        ], $messages);
    }
}
