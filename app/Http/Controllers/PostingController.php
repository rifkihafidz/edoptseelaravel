<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Posting;
use Illuminate\Http\Request;
use File;
use Carbon\Carbon;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\DB;
use App\Application;
use app\User;
use Alert;

class PostingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('users.posting');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $date = Carbon::now();

        if (empty($user->alamat or $user->no_hp)) {
            alert()->error('Harap lengkapi identitas terlebih dahulu!');
            return redirect('/profile/edit');
        }

        $request->validate([
            'img' => 'required|image|mimes:jpeg,png,jpg|min:128|max:4096',
            'name' => 'required',
            'age' => 'required|numeric|max:100',
            'category' => 'required',
            'size' => 'required',
            'sex' => 'required',
            'background' => 'required',
            'description' => 'required'
        ]);

        $data = $request->all();
        if ($request->has('vaccinated')) {
            $data['vaccinated'] = '1';
        } else {
            $data['vaccinated'] = '0';
        }

        if ($request->has('neutered')) {
            $data['neutered'] = '1';
        } else {
            $data['neutered'] = '0';
        }

        if ($request->has('friendly')) {
            $data['friendly'] = '1';
        } else {
            $data['friendly'] = '0';
        }

        if (empty($data['medical'])) {
            $data['medical'] = "-";
        }

        $data['id_user'] = $user->id;
        $data['date'] = $date;
        $data['owner'] = $user->name;
        $data['location'] = $user->alamat;
        $gambar = $request->file('img');
        $filename = time() . '.' . $gambar->getClientOriginalExtension();
        $location = public_path('/assets/uploads/' . $filename);
        Image::make($gambar)->resize(1920, 1080)->save($location);
        $data['img'] = $filename;
        Posting::create($data);

        alert()->success('Berhasil Membuat Post!');
        return redirect('/profile');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Posting  $posting
     * @return \Illuminate\Http\Response
     */
    public function show(Posting $posting)
    {
        return view('users.adopt', compact($posting));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Posting  $posting
     * @return \Illuminate\Http\Response
     */
    public function edit(Posting $posting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Posting  $posting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Posting $posting)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Posting  $posting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $posting = Posting::findorfail($request->id);

        $oldFile = public_path('/assets/uploads/' . $posting->img);

        $applications = DB::table('applications')
            ->join('postings', 'applications.id_post', '=', 'postings.id')
            ->where('applications.id_post', '=', $posting->id)
            ->delete();

        File::delete($oldFile);
        $posting->delete();

        alert()->error('Berhasil menghapus post!');
        return redirect('profile');
    }

    public function postingedit($id)
    {
        $post = Posting::where('id', $id)->firstorfail();
        if (Auth::id() != $post->id_user) {
            alert()->error('Jangan coba mengubah post yang bukan milik anda!');
            return redirect('profile');
        }

        return view('users.posting_edit', compact('post'));
    }

    public function postingupdate(Request $request, $id)
    {
        $posting = Posting::findorfail($id);
        $request->validate([
            'img' => 'image|mimes:jpeg,png,jpg,gif|min:128|max:4096'
        ]);
        if (!empty($request->img)) {
            $oldFile = public_path('/assets/uploads/' . $posting->img);
            File::delete($oldFile);
            $gambar = $request->file('img');
            $filename = time() . '.' . $gambar->getClientOriginalExtension();
            $location = public_path('/assets/uploads/' . $filename);
            Image::make($gambar)->resize(1920, 1080)->save($location);
            $posting->img = $filename;
        }
        $posting->name = $request->name;
        $posting->age = $request->age;
        $posting->category = $request->category;
        $posting->size = $request->size;
        $posting->sex = $request->sex;
        $posting->background = $request->background;
        $posting->description = $request->description;
        if (empty($request->medical)) {
            $request->medical = "-";
        }
        $posting->medical = $request->medical;
        $posting->status = $request->status;
        $posting->friendly = $request->friendly;
        $posting->neutered = $request->neutered;
        $posting->vaccinated = $request->vaccinated;

        $posting->update();

        alert()->success('Sukses mengubah post!');
        return redirect()->route('posting.edit', $id);
    }
}
