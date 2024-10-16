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

    public function edit($id){
        $user = UserModel::findOrFail($id); // Fetch user by ID
        $kelas = $this->kelasModel->getKelas(); // Fetch kelas data
        $title = 'Edit User';

        return view('edit_user', compact('user', 'kelas', 'title')); // Pass user and kelas data to edit_user view
    }

    public function update(Request $request, $id){
        // Validate incoming request data
        $request->validate([
            'nama' => 'required|string|max:255',
            'npm' => 'required|string|max:255',
            'kelas_id' => 'required|integer',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Find user by ID
        $user = UserModel::findOrFail($id);

        // Create a user array with input data
        $userData = [
            'nama' => $request->input('nama'),
            'npm' => $request->input('npm'),
            'kelas_id' => $request->input('kelas_id'),
        ];

        // Handle file upload if a new file is provided
        if ($request->hasFile('foto')) {
            // If a new file is uploaded, process it
            $foto = $request->file('foto');
            $foto_name = time() . '_' . $foto->getClientOriginalName(); // Create unique file name
            $foto->move(public_path('assets/upload/img'), $foto_name); // Move to the correct folder
            $userData['foto'] = 'assets/upload/img/' . $foto_name; // Store new relative path
        } else {
            // If no new file is uploaded, retain the existing photo path
            $userData['foto'] = $user->foto;
        }

        // Update user record with new data
        $user->fill($userData); // Fill the user model with new data
        $user->save(); // Save the changes to the database

        // Redirect with success message
        return redirect()->to('/user')->with('success', 'User berhasil diperbarui');
    }

    public function show($id){

        $user = UserModel::findOrFail($id);
        $kelas = Kelas::find($user->kelas_id); // Jika ingin menampilkan nama kelas
    
        return view('profile', [
            'title' => 'Show User',
            'user' => $user,
            'nama_kelas' => $kelas ? $kelas->nama_kelas : null, // Pastikan nama kelas ada, jika tidak tampilkan null
        ]);
    
    }

    public function destroy($id)
    {
        // Find user by ID
        $user = UserModel::findOrFail($id);

        // Optionally, you can delete the photo file if it exists
        if ($user->foto) {
            $fotoPath = public_path($user->foto); // Get the full path of the photo
            if (file_exists($fotoPath)) {
                unlink($fotoPath); // Delete the photo file from the server
            }
        }

        // Delete the user record
        $user->delete();

        // Redirect with success message
        return redirect()->to('/user')->with('success', 'User berhasil dihapus');
    }
}
