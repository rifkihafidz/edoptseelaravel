<?php

namespace App\Http\Controllers;

use app\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\City;
use App\Province;
use Intervention\Image\Facades\Image;
use File;
use App\Posting;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = User::where('id', Auth::user()->id)->firstorfail();
        $postings = DB::table('postings')->where('id_user', Auth::user()->id)->get();
        $postavail = DB::table('postings')->where('id_user', Auth::user()->id)->where('status', 'Tersedia')->get();
        $postadopted = DB::table('postings')->where('id_user', Auth::user()->id)->where('status', 'LIKE', '%Teradopsi%')->get();
        $adopts = DB::table('postings')
            ->join('adopts', 'postings.id', '=', 'adopts.id_post')
            ->where('postings.id_user', '=', $user->id)
            ->select('adopts.adoptedat as adoptdate')
            ->get();

        if (!empty($adopts)) {
            foreach ($adopts as $adopt) {
                $adopt->adoptdate;
            }
        }

        $postrip = DB::table('postings')->where('id_user', Auth::user()->id)->where('status', 'Tiada')->get();

        $applicationsent = DB::table('applications')
            ->join('postings', 'applications.id_post', '=', 'postings.id')
            ->join('users', 'postings.id_user', '=', 'users.id')
            ->where('applications.id_user', $user->id)
            ->select('postings.img as gambar', 'users.name as owner', 'postings.location as location', 'postings.name as animalsname', 'applications.*', 'users.no_hp as handphone', 'postings.id as id_post', 'users.id as id_user')
            ->get();

        $applicationsentpending = DB::table('applications')
            ->join('postings', 'applications.id_post', '=', 'postings.id')
            ->join('users', 'postings.id_user', '=', 'users.id')
            ->where('applications.id_user', $user->id)
            ->where('applications.status', '0')
            ->select('postings.img as gambar', 'users.name as owner', 'postings.location as location', 'postings.name as animalsname', 'applications.*', 'users.no_hp as handphone', 'postings.id as id_post', 'users.id as id_user')
            ->get();

        $applicationsentaccepted = DB::table('applications')
            ->join('postings', 'applications.id_post', '=', 'postings.id')
            ->join('users', 'postings.id_user', '=', 'users.id')
            ->where('applications.id_user', $user->id)
            ->where('applications.status', '1')
            ->orWhere('applications.id_user', $user->id)
            ->where('applications.status', '3')
            ->orWhere('applications.id_user', $user->id)
            ->where('applications.status', '4')
            ->select('postings.img as gambar', 'users.name as owner', 'postings.location as location', 'postings.name as animalsname', 'applications.*', 'users.no_hp as handphone', 'postings.id as id_post', 'users.id as id_user')
            ->get();

        $applicationsentrejected = DB::table('applications')
            ->join('postings', 'applications.id_post', '=', 'postings.id')
            ->join('users', 'postings.id_user', '=', 'users.id')
            ->where('applications.id_user', $user->id)
            ->where('applications.status', '2')
            ->select('postings.img as gambar', 'users.name as owner', 'postings.location as location', 'postings.name as animalsname', 'applications.*', 'users.no_hp as handphone', 'postings.id as id_post', 'users.id as id_user')
            ->get();

        $applicationreceived = DB::table('applications')
            ->join('postings', 'applications.id_post', '=', 'postings.id')
            ->join('users', 'applications.id_user', '=', 'users.id')
            ->where('postings.id_user', '=', $user->id)
            ->where('applications.id_user', '!=', $user->id)
            ->select('postings.img as gambar', 'users.name as submittername', 'postings.name as animalsname', 'applications.*', 'postings.id as id_post', 'users.id as id_user')
            ->get();

        $applicationreceivedpending = DB::table('applications')
            ->join('postings', 'applications.id_post', '=', 'postings.id')
            ->join('users', 'applications.id_user', '=', 'users.id')
            ->where('postings.id_user', '=', $user->id)
            ->where('applications.id_user', '!=', $user->id)
            ->where('applications.status', '=', '0')
            ->select('postings.img as gambar', 'users.name as submittername', 'postings.name as animalsname', 'applications.*', 'users.id as id_user')
            ->get();

        $notifreceivedpending = DB::table('applications')
            ->join('postings', 'applications.id_post', '=', 'postings.id')
            ->join('users', 'applications.id_user', '=', 'users.id')
            ->where('postings.id_user', '=', $user->id)
            ->where('applications.id_user', '!=', $user->id)
            ->where('applications.status', '=', '0')
            ->count();

        $applicationreceivedaccept = DB::table('applications')
            ->join('postings', 'applications.id_post', '=', 'postings.id')
            ->join('users', 'applications.id_user', '=', 'users.id')
            ->where('postings.id_user', '=', $user->id)
            ->where('applications.id_user', '!=', $user->id)
            ->where('applications.status', '=', '1')
            ->orWhere('postings.id_user', '=', $user->id)
            ->where('applications.id_user', '!=', $user->id)
            ->where('applications.status', '=', '3')
            ->orWhere('postings.id_user', '=', $user->id)
            ->where('applications.id_user', '!=', $user->id)
            ->where('applications.status', '=', '4')
            ->select('postings.img as gambar', 'users.name as submittername', 'postings.name as animalsname', 'applications.*', 'users.id as id_user')
            ->get();

        $applicationreceivedreject = DB::table('applications')
            ->join('postings', 'applications.id_post', '=', 'postings.id')
            ->join('users', 'applications.id_user', '=', 'users.id')
            ->where('postings.id_user', '=', $user->id)
            ->where('applications.id_user', '!=', $user->id)
            ->where('applications.status', '=', '2')
            ->select('postings.img as gambar', 'users.name as submittername', 'postings.name as animalsname', 'applications.*', 'users.id as id_user')
            ->get();

        $postapp = DB::table('postings')
            ->join('applications', 'postings.id', '=', 'applications.id_post')
            ->where('applications.id_user', '=', $user->id)
            ->select('postings.*')
            ->get();
        $provinces = Province::all();
        $cities = City::all();

        if (!empty($user->alamat)) {
            if ($adopts->isEmpty()) {
                list($prov, $kt) = explode(', ', $user->alamat);
                return view('users.profile', compact('user', 'provinces', 'cities', 'postings', 'prov', 'kt', 'postavail', 'postadopted', 'postrip', 'postapp', 'applicationreceived', 'applicationreceivedpending', 'applicationreceivedaccept', 'applicationreceivedreject', 'applicationsent', 'applicationsentpending', 'applicationsentaccepted', 'applicationsentrejected', 'notifreceivedpending'));
            } else {
                list($prov, $kt) = explode(', ', $user->alamat);
                return view('users.profile', compact('user', 'provinces', 'cities', 'postings', 'prov', 'kt', 'postavail', 'postadopted', 'postrip', 'postapp', 'applicationreceived', 'applicationreceivedpending', 'applicationreceivedaccept', 'applicationreceivedreject', 'applicationsent', 'applicationsentpending', 'applicationsentaccepted', 'applicationsentrejected', 'notifreceivedpending', 'adopt'));
            }
        } else {
            return view('users.profile', compact('user', 'provinces', 'cities', 'postings', 'postavail', 'postadopted', 'postrip', 'postapp', 'applicationreceived', 'applicationreceivedpending', 'applicationreceivedaccept', 'applicationreceivedreject', 'applicationsent', 'applicationsentpending', 'applicationsentaccepted', 'applicationsentrejected', 'notifreceivedpending'));
        }
    }

    public function edit()
    {
        $provinces = Province::all();
        $cities = City::all();
        $user = User::where('id', Auth::user()->id)->firstorfail();

        return view('users.profile_edit', compact('user', 'provinces', 'cities'));
    }

    public function update(Request $request)
    {
        $user = User::where('id', Auth::user()->id)->firstorfail();

        $this->validate($request, [
            'password' => 'confirmed',
            'no_hp' => 'required|numeric|min:8',
            'avatar' => 'image|mimes:jpeg,png,jpg|min:64|max:2048'
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

        $provinces = Province::all();
        $cities = City::orderBy('name', 'asc')->get();

        if ($request->province != "Pilih Provinsi...") {
            foreach ($provinces as $province) {
                if ($province->id == $request->province) {
                    $namaProvinsi = $province->name;
                }
            }
            foreach ($cities as $city) {
                if ($city->id ==  $request->city) {
                    $namaCity = $city->name;
                }
            }
            $location = $namaProvinsi . ', ' . $namaCity;
        } elseif ($request->city != "Pilih Kota...") {
            foreach ($cities as $city) {
                if ($request->city == $city->id) {
                    $idprovinsi = $city->province_id;
                    $namaCity = $city->name;
                }
            }
            foreach ($provinces as $province) {
                if ($idprovinsi == $province->id) {
                    $namaProvinsi = $province->name;
                }
            }
            $location = $namaProvinsi . ', ' . $namaCity;
        }

        $province = Province::where('id', $request->province)->first();
        $city = City::where('id', $request->city)->first();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->no_hp = $request->no_hp;

        if ($request->province == 'Pilih Provinsi...') {
            if ($request->city != 'Pilih Kota...') {
                $user->alamat = $location;
            }
        } elseif ($request->province != 'Pilih Provinsi...') {
            $user->alamat = $location;
        }

        if (!empty($request->password)) {
            $user->password = Hash::make($request->password);
        }

        $user->update();

        alert()->success('Sukses mengubah profil!');
        return redirect()->route('profile');
    }

    public function details($id)
    {
        $user = User::findorfail($id);
        $allposts = Posting::where('id_user', $id)->paginate();
        $availableposts = Posting::where('id_user', $id)->where('status', 'Tersedia')->get();
        $adoptedposts = Posting::where('id_user', $id)->where('status', 'LIKE', 'Teradopsi%')->get();

        return view('users.profile_detail', compact('user', 'allposts', 'availableposts', 'adoptedposts'));
    }
}
