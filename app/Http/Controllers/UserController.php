<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserModel;
use App\Models\Kelas;

class UserController extends Controller
{
    public $userModel;
    public $kelasModel;

    public function __construct(){
        $this->userModel = new UserModel();
        $this->kelasModel = new Kelas();
    }

    public function index(){
        $data = [
            'title' => 'List User',
            'users' => $this->userModel->getUser(), // Fetch users
        ];

        return view('list_user', $data);
    }

    public function profile(){
        return view('profile'); // Fetch user data based on session or other means
    }

    public function create(){
        $kelas = $this->kelasModel->getKelas(); // Fetch kelas data
        $data = [  
            'title' => 'Create User',
            'kelas' => $kelas,
        ];

        return view('create_user', $data);
    }

    public function store(Request $request){
        // Validate incoming request data
        $request->validate([
            'nama' => 'required|string|max:255',
            'npm' => 'required|string|max:255',
            'kelas_id' => 'required|integer',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $fotoPath = null; // Initialize fotoPath

        // Handle file upload if a file is provided
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $foto_name = time() . '_' . $foto->getClientOriginalName(); // Create unique file name
            $foto->move(public_path('assets/upload/img'), $foto_name); // Move to the correct folder
            $fotoPath = 'assets/upload/img/' . $foto_name; // Store relative path
        }

        // Create a new user record
        $this->userModel->create([
            'nama' => $request->input('nama'),
            'npm' => $request->input('npm'),
            'kelas_id' => $request->input('kelas_id'),
            'foto' => $fotoPath,
        ]);

        // Redirect with success message
        return redirect()->to('/user')->with('success', 'User berhasil ditambahkan');
    }

    public function show($id){
        $user = $this->userModel->getUser($id); // Fetch user by ID
        $data = [
            'title' => 'Profile',
            'user' => $user,
        ];

        return view('profile', $data); // Pass user data to profile view
    }
}
