<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use App\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return View::make('user.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $message = [
            'required' => 'Inputan :attribute wajib diisi'
        ];
        $customAttributes = [
            'user_login' => 'ID User',
            'user_email' => 'Email'
        ];
        $validator = Validator::make($request->all(), [
            'user_email' => [
                'required',
                'email',
                'max:50',
            ],
            'user_login' => [
                'required',
                'max:30',
            ]
        ], $message, $customAttributes);
        if ($validator->fails()) {
            return \redirect('pengguna/tambah')
                ->withErrors($validator)
                ->withInput();
        }
        $user = new User();
        $user->login = $request->input('user_login');
        $user->email = $request->input('user_email');
        $user->pswd = Hash::make($request->input('user_password'));
        $user->deskripsi = $request->input('user_deskripsi');
        if ($user->save()) {
            return \redirect('/');
//            return response()->json(['status' => 1, 'msg' => 'Data berhasil disimpan']);
        } else {
            return \redirect('pengguna/tambah');
//            return response()->json(['status' => 0, 'msg' => 'Data gagal disimpan']);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  base64  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $decyper = explode('&', base64_decode($id));
        $email = $decyper[0];
        $login = $decyper[1];
        $user = User::where('email', '=', $email)
            ->where('login', '=', $login)
            ->first();
        return View::make('user.ubah')->with(['data' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $decyper = explode('&', base64_decode($id));
        $email = $decyper[0];
        $login = $decyper[1];

        $message = [
            'required' => 'Inputan :attribute wajib diisi'
        ];
        $customAttributes = [
            'user_email' => 'Email'
        ];
        $validator = Validator::make($request->all(), [
            'user_email' => [
                'required',
                'email',
                'max:50',
            ]
        ], $message, $customAttributes);
        if ($validator->fails()) {
            return \redirect('pengguna/tambah')
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::where('login', '=', $login)
            ->where('email', '=', $email)->first();
        $password = '';
        if (!empty($request->input('user_password'))) {
            if (!Hash::check($request->input('user_password'), $user->password)) {
                $password = Hash::make($request->input('user_password'));
            }
        }
        $set = [];
        if (!empty($password)) {
            $set['pswd'] = $password;
        }
        $set['deskripsi'] = $request->input('user_deskripsi');
        $update = DB::table('users')->where('login', '=', $login)
            ->where('email', '=', $email)
            ->update($set);
        if ($update) {
            return \redirect('/');
        } else {
            return \redirect('pengguna/ubah/'.$id);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $decyper = explode('&', base64_decode($id));
        $email = $decyper[0];
        $login = $decyper[1];

        $delete = DB::table('users')
            ->where('login', '=', $login)
            ->where('email', '=', $email)
            ->delete();
        if ($delete) {
            return response()->json(['status' => 1, 'msg' => 'Data berhasil dihapus']);
        } else {
            return response()->json(['status' => 0, 'msg' => 'Data gagal dihapus']);
        }
    }

    /**
     * Get all record from database
     */
    public function data()
    {
        $user = User::all();
        $data = new \stdClass();
        if ($user !== null) {
            $data->data = $user;
        } else {
            $data->data = [];
        }
        return response()->json($data);
    }

    /**
     * Get spesific record from database
     *
     * @param $id
     */
    public function data_id($id)
    {
        $user = User::where('login', '=', $id)
            ->where('email', '=', $id)->first();
        $data = new \stdClass();
        if ($user !== null) {
            $data->data = $user;
        } else {
            $data->data = [];
        }
        return response()->json($data);
    }

    public function login(Request $request)
    {
        $user = User::where('login','=',$request->user_login)
            ->first();
        if ($user) {
//            return View::make('user.home')->with(['user' => $user]);
            return redirect('home')->with('user', $user->login);
        } else {
            return redirect('login')->withErrors(['user' => 'tidak ditemukan']);
        }
    }

    public function logout(Request $request)
    {
        $request->session()->forget('user');
        return redirect('/');
    }
}
