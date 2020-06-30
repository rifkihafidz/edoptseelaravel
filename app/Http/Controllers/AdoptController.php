<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Posting;
use App\City;
use App\Province;
use App\User;
use App\Application;
use App\Adopt;
use App\PostCategory;

class AdoptController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = User::where('id', Auth::user()->id)->firstorfail();
        $provinces = Province::all();
        $cities = City::orderBy('name', 'asc')->get();

        $postings = DB::table('postings')->paginate(6);

        return view('users.adopt', compact('postings', 'provinces', 'cities', 'user'));
    }

    public function details($id)
    {
        $user = User::where('id', Auth::user()->id)->firstorfail();
        $post = Posting::where('id', $id)->firstorfail();

        $ownerphone = DB::table('users')
            ->join('postings', 'users.id', '=', 'postings.id_user')
            ->where('users.id', '=', $post->id_user)
            ->select('users.no_hp as phone')
            ->get();

        foreach ($ownerphone as $owner) {
            $owner->phone;
        }

        return view('users.adopt_detail', compact('post', 'user', 'ownerphone', 'owner'));
    }

    public function applyform(Request $request, $id)
    {
        $user = Auth::user();
        $post = Posting::findorfail($id);
        // $owner_id = $post->id_user;
        $adopter = User::where('id', Auth::user()->id)->firstorfail();
        $date = Carbon::now();

        // Validasi alamat dan no telpon
        if (empty($user->alamat and $user->no_hp)) {
            alert()->error('Harap lengkapi identitas terlebih dahulu!');
            return redirect('/profile/edit');
        }

        $applycheck = Application::where('id_user', Auth::user()->id)->where('status', 0)->orWhere('id_user', Auth::user()->id)->Where('status', 1)->get();

        // Validasi data
        $request->validate([
            'reason' => 'required|min:10',
            'otheranimals' => 'required|min:10',
            'permissions' => 'required|min:3'
        ]);

        $ada = "";

        // Cek di tabel ada id_post yang akan disubmit atau tidak
        foreach ($applycheck as $app) {
            if ($app->id_post == $id) {
                // Kalau id_postnya ada
                $ada = $id;
            }
        }

        // Kalau request $id != application->id_post yang sudah disubmit 
        if ($id != $ada) {
            $data = $request->all();
            $data['id_user'] = $adopter->id;
            $data['id_post'] = $post->id;
            $data['apply_date'] = $date;

            // Apus ini
            $data['phone'] = $adopter->no_hp;
            $data['location'] = $adopter->alamat;

            Application::create($data);

            alert()->success('Form application sent!');
            return redirect()->route('details', $id);
        } else {
            alert()->error('You have already sent the application or Your submitation has been accepted by the owner');
            return back();
        }
    }

    public function acceptapply(Request $request)
    {
        $application = Application::findorfail($request->id);
        $application->status = 1;
        $application->update();
        alert()->success('Success accept appliances!');
        return back();
    }

    public function rejectapply(Request $request)
    {
        $application = Application::findorfail($request->id);
        $application->status = 2;
        $application->update();
        alert()->success('Success reject appliances!');
        return back();
    }

    public function setadopter(Request $request)
    {
        $application = Application::findorfail($request->idapply);
        $post = Posting::findorfail($request->idpost);

        // Update status applications selain calon adopter menjadi 4 (user lain telah menjadi adopter)
        $others = DB::table('applications')
            ->join('postings', 'applications.id_post', '=', 'postings.id')
            ->where('postings.id', '=', $request->idpost)
            ->where('applications.id', '!=', $request->idapply)
            ->update(['applications.status' => DB::raw(4)]);

        // Update status applications yang menjadi adopter
        $adopters = DB::table('users')
            ->join('applications', 'users.id', '=', 'applications.id_user')
            ->where('applications.id', '=', $application->id)
            ->where('users.id', '=', $application->id_user)
            ->select('users.id as id_adopter', 'users.name as name')
            ->get();

        foreach ($adopters as $adopter) {
            $adopter;
        }

        $owners = DB::table('users')
            ->join('postings', 'users.id', '=', 'postings.id_user')
            ->where('postings.id', '=', $post->id)
            ->where('users.id', '=', $post->id_user)
            ->select('users.id as id_owner', 'users.name as name')
            ->get();

        foreach ($owners as $owner) {
            $owner;
        }

        $adopt = Adopt::create([
            'id_owner' => $owner->id_owner,
            'id_adopter' => $adopter->id_adopter,
            'id_post' => $post->id,
            'id_application' => $application->id,
            'adoptedat' => Carbon::now(),
        ]);

        $adopt->save();
        $post->status = 'Adopted by ' . $adopter->name;
        $post->update();
        $application->status = 3;
        $application->update();
        alert()->success('Success set ' . $adopter->name . ' as ' . $post->name . ' adopter!');
        return back();
    }

    public function getCities(Request $request)
    {
        $cities = Province::findorfail($request->province)->city;

        if ($request->province !== 'Select Province...') {
            return $cities;
        }
    }

    public function getAllCities()
    {
        $cities = City::all();
        return $cities;
    }

    public function filters(Request $request)
    {
        $search = $request->name;
        $category = $request->category;
        $provinces = Province::all();
        $cities = City::orderBy('name', 'asc')->get();

        if ($request->province != "Select Province...") {
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
            $lokasi = $namaProvinsi . ', ' . $namaCity;
        } elseif ($request->city != "Select City...") {
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
            $lokasi = $namaProvinsi . ', ' . $namaCity;
        }

        if ($request->province == 'Select Province...') {
            // Province kosong
            if ($request->city == 'Select City...') {
                // City kosong
                if ($request->category == 'Select Category...') {
                    // Category kosong
                    if (empty($search)) {
                        // Name kosong
                        if ($request->has('availablecheckbox')) {
                            // Available
                            $postings = DB::table('postings')->where('status', 'Available')->paginate(6);
                        } else {
                            // All
                            $postings = DB::table('postings')->paginate(6);
                        }

                        return view('users.adopt', compact('postings', 'provinces', 'cities'));
                    } elseif (!empty($search)) {
                        // Name terisi
                        if ($request->has('availablecheckbox')) {
                            // Available
                            $postings = DB::table('postings')->where('name', 'LIKE', "%$search%")->where('status', 'Available')->paginate(6);
                        } else {
                            // All
                            $postings = DB::table('postings')->where('name', 'LIKE', "%$search%")->paginate(6);
                        }

                        return view('users.adopt', compact('postings', 'provinces', 'cities'));
                    }
                } elseif ($request->category != 'Select Category...') {
                    // Category terisi
                    if (empty($search)) {
                        // Name kosong
                        if ($request->has('availablecheckbox')) {
                            // Available
                            $postings = DB::table('postings')->where('category', $request->category)->where('status', 'Available')->paginate(6);
                        } else {
                            // All
                            $postings = DB::table('postings')->where('category', $request->category)->paginate(6);
                        }

                        return view('users.adopt', compact('postings', 'provinces', 'cities'));
                    } elseif (!empty($search)) {
                        // Name terisi
                        if ($request->has('availablecheckbox')) {
                            // Available
                            $postings = DB::table('postings')->where('category', $request->category)->where('name', 'LIKE', "%$search%")->where('status', 'Available')->paginate(6);
                        } else {
                            // All
                            $postings = DB::table('postings')->where('category', $request->category)->where('name', 'LIKE', "%$search%")->paginate(6);
                        }

                        return view('users.adopt', compact('postings', 'provinces', 'cities'));
                    }
                }
            } elseif ($request->city != 'Select City...') {
                // City terisi
                if ($request->category == 'Select Category...') {
                    // Category kosong
                    if (empty($search)) {
                        // Name kosong
                        if ($request->has('availablecheckbox')) {
                            // Available
                            $postings = DB::table('postings')->where('location', $lokasi)->where('status', 'Available')->paginate(6);
                        } else {
                            // All
                            $postings = DB::table('postings')->where('location', $lokasi)->paginate(6);
                        }

                        return view('users.adopt', compact('postings', 'provinces', 'cities'));
                    } elseif (!empty($search)) {
                        // Name terisi
                        if ($request->has('availablecheckbox')) {
                            // Available
                            $postings = DB::table('postings')->where('location', $lokasi)->where('name', 'LIKE', "%$search%")->where('status', 'Available')->paginate(6);
                        } else {
                            // All
                            $postings = DB::table('postings')->where('location', $lokasi)->where('name', 'LIKE', "%$search%")->paginate(6);
                        }

                        return view('users.adopt', compact('postings', 'provinces', 'cities'));
                    }
                } elseif ($request->category != 'Select Category...') {
                    // Category terisi
                    if (empty($search)) {
                        // Name kosong
                        if ($request->has('availablecheckbox')) {
                            // Available
                            $postings = DB::table('postings')->where('location', $lokasi)->where('category', $request->category)->where('status', 'Available')->paginate(6);
                        } else {
                            // All
                            $postings = DB::table('postings')->where('location', $lokasi)->where('category', $request->category)->paginate(6);
                        }

                        return view('users.adopt', compact('postings', 'provinces', 'cities'));
                    } elseif (!empty($search)) {
                        // Name terisi
                        if ($request->has('availablecheckbox')) {
                            // Available
                            $postings = DB::table('postings')->where('location', $lokasi)->where('category', $request->category)->where('name', 'LIKE', "%$search%")->where('status', 'Available')->paginate(6);
                        } else {
                            // All
                            $postings = DB::table('postings')->where('location', $lokasi)->where('category', $request->category)->where('name', 'LIKE', "%$search%")->paginate(6);
                        }

                        return view('users.adopt', compact('postings', 'provinces', 'cities'));
                    }
                }
            }
        } elseif ($request->province != 'Select Province...') {
            // Province terisi
            if ($request->category == 'Select Category...') {
                // Category kosong
                if (empty($search)) {
                    // Name kosong
                    if ($request->has('availablecheckbox')) {
                        // Available
                        $postings = DB::table('postings')->where('location', $lokasi)->where('status', 'Available')->paginate(6);
                    } else {
                        // All
                        $postings = DB::table('postings')->where('location', $lokasi)->paginate(6);
                    }

                    return view('users.adopt', compact('postings', 'provinces', 'cities'));
                } elseif (!empty($search)) {
                    // Name terisi
                    if ($request->has('availablecheckbox')) {
                        // Available
                        $postings = DB::table('postings')->where('location', $lokasi)->where('name', 'LIKE', "%$search%")->where('status', 'Available')->paginate(6);
                    } else {
                        // All
                        $postings = DB::table('postings')->where('location', $lokasi)->where('name', 'LIKE', "%$search%")->paginate(6);
                    }

                    return view('users.adopt', compact('postings', 'provinces', 'cities'));
                }
            } elseif ($request->category != 'Select Category...') {
                // Category terisi
                if (empty($search)) {
                    // Name kosong
                    if ($request->has('availablecheckbox')) {
                        // Available
                        $postings = DB::table('postings')->where('location', $lokasi)->where('category', $request->category)->where('status', 'Available')->paginate(6);
                    } else {
                        // All
                        $postings = DB::table('postings')->where('location', $lokasi)->where('category', $request->category)->paginate(6);
                    }

                    return view('users.adopt', compact('postings', 'provinces', 'cities'));
                } elseif (!empty($search)) {
                    // Name terisi
                    if ($request->has('availablecheckbox')) {
                        // Available
                        $postings = DB::table('postings')->where('location', $lokasi)->where('category', $request->category)->where('name', 'LIKE', "%$search%")->where('status', 'Available')->paginate(6);
                    } else {
                        // All
                        $postings = DB::table('postings')->where('location', $lokasi)->where('category', $request->category)->where('name', 'LIKE', "%$search%")->paginate(6);
                    }

                    return view('users.adopt', compact('postings', 'provinces', 'cities'));
                }
            }
        }
    }
}
