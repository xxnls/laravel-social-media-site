<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\PseudoTypes\LowercaseString;

class UsersController extends Controller
{
    //Show register/create form
    public function create(){
        return view('users.register', ["pageTitle"=>"Register"]);
    }

    //Store new user
    public function store(Request $request){
        $formFields = $request->validate([
            //'name' => ['required', 'min:5'],
            'email' => ['required', 'email'],
            'password' => ['required', 'min:8', 'confirmed'],
            'first_name' => ['required', 'min:2', 'max:100'],
            'last_name' => ['required', 'min:2', 'max:100'],
            'gender' => ['required'],
            'date_of_birth' => ['required', 'date']
        ]);

        //Create username
        $formFields['name'] = strtolower(substr($request->input('first_name'), 0, 3) . substr($request->input('last_name'), 0, 3) . mt_rand(10000, 99999));

        //Hash password
        $formFields['password'] = bcrypt($formFields['password']);

        //Create new user
        $user = User::create($formFields);

        //Login
        auth()->login($user);

        return redirect('/')->with('message', 'User created successfully.');
    }

    //Logout user
    public function logout(Request $request){
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('message', 'User logged out successfully.');
    }

    //Show login form
    public function login(){
        return view('users.login', ["pageTitle"=>"Login"]);
    }

    //Authenticate user
    public function authenticate(Request $request){
        $credentials = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        if(auth()->attempt($credentials)){
            $request->session()->regenerate();

            return redirect('/')->with('message', 'User logged in successfully.');
        }

        return back()->withErrors(['login_info' => 'The provided credentials do not match our records.',])->onlyInput();
    }

    //Show user settings
    public function settings($id){
        $model = User::find($id);
        return view('users.user-settings.settings', ["model"=>$model, "pageTitle"=>"User settings"]);
    }

    //Show change credentials form
    public function credentials($id){
        $model = User::find($id);
        return view('users.user-settings.edit-credentials', ["model"=>$model, "pageTitle"=>"Change credentials"]);
    }

    //Update user credentials
    public function update(Request $request, $id){
        $formFields = $request->validate([
            'first_name' => ['required', 'min:2', 'max:100'],
            'last_name' => ['required', 'min:2', 'max:100'],
            'gender' => ['required'],
            'date_of_birth' => ['required', 'date']
        ]);

        $user=User::find($id);
        $user->update($formFields);

        return redirect('users/'.$user->id.'/settings')->with('message', 'User credentials updated successfully.');
    }

    //Show change email form
    public function email($id){
        $model = User::find($id);
        return view('users.user-settings.edit-email', ["model"=>$model, "pageTitle"=>"Change email"]);
    }

    //Update user email
    public function updateEmail(Request $request, $id){
        $formFields = $request->validate([
            'email' => ['required', 'email', 'confirmed']
        ]);

        $user=User::find($id);
        $user->update($formFields);

        return redirect('users/'.$user->id.'/settings')->with('message', 'User email updated successfully.');
    }

    //Show change password form
    public function password($id){
        $model = User::find($id);
        return view('users.user-settings.edit-password', ["model"=>$model, "pageTitle"=>"Change password"]);
    }

    //Update user password
    public function updatePassword(Request $request, $id){
        $formFields = $request->validate([
            'password' => ['required', 'min:8', 'confirmed']
        ]);

        $formFields['password'] = bcrypt($formFields['password']);

        $user=User::find($id);
        $user->update($formFields);

        return redirect('users/'.$user->id.'/settings')->with('message', 'User password updated successfully.');
    }

    //Show change profile image form
    public function profileImage($id){
        $model = User::find($id);
        return view('users.user-settings.edit-profile-image', ["model"=>$model, "pageTitle"=>"Change profile image"]);
    }

    //Update user profile image
    public function updateProfileImage(Request $request, $id){
        $formFields = $request->validate([
            'profile_image_path' => ['required']
        ]);


        $user=User::find($id);

        $image = $request->file('profile_image_path');
        $imageName = auth()->user()->name . time() . '.' . $image->extension();
        $image->move(public_path('img/users/'), $imageName);
        $formFields['profile_image_path'] = $imageName;

        $user->update($formFields);


        return redirect('users/'.$user->id.'/settings')->with('message', 'User profile image updated successfully.');
    }

    //Show delete user form
    public function delete($id){
        $model = User::find($id);

        //Generate random code for confirmation
        $confirmationCode = mt_rand(100000, 999999);

        return view('users.user-settings.delete', ["model"=>$model, "confirmationCode"=>$confirmationCode ,"pageTitle"=>"Delete user"]);
    }

    //Delete user
    public function destroy(Request $request, $id){
        $formFields = $request->validate([
            'password' => ['required'],
            'confirmationCode' => ['required', 'numeric', 'digits_between:6,6'],
        ]);

        // Check if the confirmation code matches the generated code
        if ($formFields['confirmationCode'] != $request->get('confirmationCode')) {
            return redirect()->back()->withErrors(['confirmationCode' => 'Invalid confirmation code.'])->withInput();
        }

        $user = User::find($id);

        //Check if password is correct
        if (!auth()->attempt(['email' => $user->email, 'password' => $formFields['password']])) {
            return redirect()->back()->withErrors(['password' => 'Invalid password.'])->withInput();
        }

        //Delete all user posts
        $posts = Post::where("user_id","=",$user->id)->get();
        foreach($posts as $post){
            //$post->is_active = 0;
            //$post->update();
            $post->delete();
        }

        //Delete user
        //$user->is_active = 0;
        //$user->update();
        $user->delete();

        //Logout, invalidate session and redirect
        auth()->logout();
        $request->session()->invalidate();

        return redirect('/')->with('message', 'Account deleted.');
    }
}
