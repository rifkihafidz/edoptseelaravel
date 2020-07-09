<?php

namespace App\Http\Controllers;

use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use App\Adopt;
use App\Application;
use App\Posting;
use App\User;
use Intervention\Image\Facades\Image;
use File;
use Alert;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    function dashboard(Request $request)
    {
        $datetime = Carbon::now()->isoFormat('dddd, D MMMM Y');

        return view('admin.dashboard', compact('datetime'));
    }

    function adoptdata()
    {
        $datetime = Carbon::now()->isoFormat('dddd, D MMMM Y');
        $adopts = DB::table('adopts')
            ->join('postings', 'adopts.id_post', '=', 'postings.id')
            ->join('users as owner', 'adopts.id_owner', '=', 'owner.id')
            ->join('users as adopter', 'adopts.id_adopter', '=', 'adopter.id')
            ->join('applications', 'adopts.id_application', '=', 'applications.id')
            ->select('owner.name as ownername', 'adopter.name as adoptername', 'postings.name as animalname', 'adopts.id as idadopts', 'adopts.id_owner as idowners', 'adopts.id_adopter as idadopters', 'adopts.id_post as idposts', 'adopts.id_application as idapplications', 'adopts.adoptedat as adoptedat')
            ->get();
        return view('admin.adopt_data', compact('datetime', 'adopts'));
    }

    function applicationdata()
    {
        $datetime = Carbon::now()->isoFormat('dddd, D MMMM Y');
        $applications = DB::table('applications')
            ->join('postings', 'applications.id_post', '=', 'postings.id')
            ->join('users', 'applications.id_user', '=', 'users.id')
            ->select('applications.*', 'users.name as name', 'postings.name as animalsname')
            ->get();

        return view('admin.application_data', compact('datetime', 'applications'));
    }

    function postingdata()
    {
        $datetime = Carbon::now()->isoFormat('dddd, D MMMM Y');
        $postings = Posting::all();

        return view('admin.posting_data', compact('datetime', 'postings'));
    }

    function postingdataedit($id)
    {
        $datetime = Carbon::now()->isoFormat('dddd, D MMMM Y');
        $post = Posting::findorfail($id);

        return view('admin.posting_data_edit', compact('datetime', 'post'));
    }

    function postingdataupdate(Request $request, $id)
    {
        $post = Posting::findorfail($id);
        $request->validate([
            'img' => 'image|mimes:jpeg,png,jpg,gif|min:128|max:4096'
        ]);
        if (!empty($request->img)) {
            $oldFile = public_path('/assets/uploads/' . $post->img);
            File::delete($oldFile);
            $gambar = $request->file('img');
            $filename = time() . '.' . $gambar->getClientOriginalExtension();
            $location = public_path('/assets/uploads/' . $filename);
            Image::make($gambar)->resize(1920, 1080)->save($location);
            $post->img = $filename;
        }
        $post->name = $request->name;
        $post->age = $request->age;
        $post->category = $request->category;
        $post->size = $request->size;
        $post->sex = $request->sex;
        $post->background = $request->background;
        $post->description = $request->description;
        if (empty($request->medical)) {
            $request->medical = "-";
        }
        $post->medical = $request->medical;
        $post->status = $request->status;

        $post->update();

        alert()->success('Update success!');
        return redirect()->route('admin.posting.edit', $id);
    }

    function postingdatadestroy(Request $request)
    {
        $posting = Posting::findorfail($request->id);

        $oldFile = public_path('/assets/uploads/' . $posting->img);

        // Delete applications dan adopts yang postnya mau didelete
        $applications = DB::table('applications')
            ->join('postings', 'applications.id_post', '=', 'postings.id')
            ->where('applications.id_post', '=', $posting->id)
            ->delete();

        $adopts = DB::table('adopts')
            ->join('postings', 'adopts.id_post', 'postings.id')
            ->where('adopts.id_post', '=', $posting->id)
            ->delete();

        File::delete($oldFile);
        $posting->delete();

        alert()->error('Successfully deleted the post!');
        return back();
    }

    function userdata()
    {
        $datetime = Carbon::now()->isoFormat('dddd, D MMMM Y');
        $users = User::all();

        return view('admin.user_data', compact('datetime', 'users'));
    }

    function userdataedit($id)
    {
        $datetime = Carbon::now()->isoFormat('dddd, D MMMM Y');
        $user = User::findorfail($id);

        return view('admin.user_data_edit', compact('datetime', 'user'));
    }

    function userdataupdate(Request $request, $id)
    {
        $user = User::findorfail($id);
        $this->validate($request, [
            'avatar' => 'image|mimes:jpeg,png,jpg|min:64|max:2048',
            'password' => 'confirmed|min:8',
        ]);
        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            Image::make($avatar)->resize(75, 75)->save(public_path('/assets/uploads/avatars/' . $filename));
            if ($user->avatar != 'default.jpg') {
                $oldFile = public_path('/assets/uploads/avatars/' . $user->avatar);
                File::delete($oldFile);
            }
            $user->avatar = $filename;
        }
        $user->name = $request->name;
        if (!empty($request->password)) {
            $user->password = Hash::make($request->password);
        }
        $user->role = $request->role;
        if (!empty($request->password)) {
            $user->password = Hash::make($request->password);
        }
        $user->update();
        alert()->success('Success updating profile!');
        return back();
    }

    function userdatadestroy(Request $request)
    {
        $user = User::findorfail($request->id);
        if ($user->avatar != 'default.jpg') {
            $oldFile = public_path('/assets/uploads/avatars/' . $user->avatar);
            File::delete($oldFile);
        }

        // Delete postings, applications dan adopts yang usernya mau didelete
        $applications = DB::table('applications')
            ->join('users', 'applications.id_user', '=', 'users.id')
            ->where('applications.id_user', '=', $user->id)
            ->delete();

        $owners = DB::table('adopts')
            ->join('users', 'adopts.id_owner', 'users.id')
            ->where('adopts.id_owner', '=', $user->id)
            ->delete();

        $adopter = DB::table('adopts')
            ->join('users', 'adopts.id_adopter', 'users.id')
            ->where('adopts.id_adopter', '=', $user->id)
            ->delete();

        // Delete gambar di public path
        $postdeletes = DB::table('postings')
            ->join('users', 'postings.id_user', 'users.id')
            ->where('postings.id_user', '=', $user->id)
            ->get();

        foreach ($postdeletes as $postdelete) {
            $oldFiles = public_path('/assets/uploads/' . $postdelete->img);
            if (File::exists($oldFiles)) {
                File::delete($oldFiles);
            }
        }

        $postings = DB::table('postings')
            ->join('users', 'postings.id_user', 'users.id')
            ->where('postings.id_user', '=', $user->id)
            ->delete();

        $user->delete();

        alert()->error('Successfully deleted this user!');
        return back();
    }
}
