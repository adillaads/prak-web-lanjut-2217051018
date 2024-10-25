<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserModel;
use App\Models\Kelas;
use App\Models\Jurusan; // Import model Jurusan

class UserController extends Controller
{
    public $userModel;
    public $kelasModel;
    public $jurusanModel;

    public function __construct(){
        $this->userModel = new UserModel();
        $this->kelasModel = new Kelas();
        $this->jurusanModel = new Jurusan();
    }

    public function index(){
        $data = [
            'title' => 'List User',
            'users' => $this->userModel->getUser(), // Fetch users
        ];

        return view('list_user', $data);
    }

    public function create(){
        $kelas = $this->kelasModel->getKelas();
        $jurusan_id = Jurusan::all(); // Fetch kelas data
        
        $data = [  
            'title' => 'Create User',
            'kelas' => $kelas,
            'jurusan' => $jurusan_id,
            // Tidak perlu mengirim jurusan di sini karena kita hanya mengambilnya di view
        ];

        return view('create_user', $data);
    }

    public function store(Request $request){
        // Validasi incoming request data
        $request->validate([
            'nama' => 'required|string|max:255',
            'npm' => 'required|string|max:255',
            'kelas_id' => 'required|integer',
            'jurusan_id' => 'required|exists:jurusan,id', // Pastikan jurusan_id sebagai string
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $fotoPath = null; // Inisialisasi path foto

        // Meng-handle upload file jika ada
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $foto_name = time() . '_' . $foto->getClientOriginalName();
            $foto->move(public_path('assets/upload/img'), $foto_name);
            $fotoPath = 'assets/upload/img/' . $foto_name;
        }

        // Membuat data user baru
        $this->userModel->create([
            'nama' => $request->input('nama'),
            'npm' => $request->input('npm'),
            'kelas_id' => $request->input('kelas_id'),
            'jurusan_id' =>$request->input('jurusan_id'), // Simpan nama jurusan sebagai string
            'foto' => $fotoPath,
        ]);

        // Redirect ke list_user dengan pesan sukses
        return redirect()->to('/')->with('success', 'User Berhasil dibuat');
    }
    
    // public function edit($id){
    //     $user = UserModel::findOrFail($id); // Fetch user by ID
    //     $kelas = $this->kelasModel->getKelas(); // Fetch kelas data
    //     $title = 'Edit User';

    //     return view('edit_user', compact('user', 'kelas', 'title')); // Pass user and kelas data to edit_user view
    // }

    // public function update(Request $request, $id){
    //     // Validate incoming request data
    //     $request->validate([
    //         'nama' => 'required|string|max:255',
    //         'npm' => 'required|string|max:255',
    //         'kelas_id' => 'required|integer',
    //         'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    //     ]);

    //     // Find user by ID
    //     $user = UserModel::findOrFail($id);

    //     // Create a user array with input data
    //     $userData = [
    //         'nama' => $request->input('nama'),
    //         'npm' => $request->input('npm'),
    //         'kelas_id' => $request->input('kelas_id'),
    //     ];

    //     // Handle file upload if a new file is provided
    //     if ($request->hasFile('foto')) {
    //         // If a new file is uploaded, process it
    //         $foto = $request->file('foto');
    //         $foto_name = time() . '_' . $foto->getClientOriginalName(); // Create unique file name
    //         $foto->move(public_path('assets/upload/img'), $foto_name); // Move to the correct folder
    //         $userData['foto'] = 'assets/upload/img/' . $foto_name; // Store new relative path
    //     } else {
    //         // If no new file is uploaded, retain the existing photo path
    //         $userData['foto'] = $user->foto;
    //     }

    //     // Update user record with new data
    //     $user->fill($userData); // Fill the user model with new data
    //     $user->save(); // Save the changes to the database

    //     // Redirect with success message
    //     return redirect()->to('/user')->with('success', 'User berhasil diperbarui');
    // }

    // public function show($id){

    //     $user = UserModel::findOrFail($id);
    //     $kelas = Kelas::find($user->kelas_id); // Jika ingin menampilkan nama kelas
    
    //     return view('profile', [
    //         'title' => 'Show User',
    //         'user' => $user,
    //         'nama_kelas' => $kelas ? $kelas->nama_kelas : null, // Pastikan nama kelas ada, jika tidak tampilkan null
    //     ]);
    
    // }

    // public function destroy($id)
    // {
    //     // Find user by ID
    //     $user = UserModel::findOrFail($id);

    //     // Optionally, you can delete the photo file if it exists
    //     if ($user->foto) {
    //         $fotoPath = public_path($user->foto); // Get the full path of the photo
    //         if (file_exists($fotoPath)) {
    //             unlink($fotoPath); // Delete the photo file from the server
    //         }
    //     }

    //     // Delete the user record
    //     $user->delete();

    //     // Redirect with success message
    //     return redirect()->to('/user')->with('success', 'User berhasil dihapus');
    // }

    public function edit($id)
    {

        $user = UserModel::findOrFail($id);
        $kelasModel = new Kelas();
        $kelas = $kelasModel->getKelas();
        $title = 'Edit User';

        return view('edit_user', compact('user', 'kelas', 'title'));
    }

    public function update(Request $request, $id)
    {
        $user = UserModel::findOrFail($id);

        // Update data user lainnya
        $user->nama = $request->nama;
        $user->npm = $request->npm;
        $user->kelas_id = $request->kelas_id;

        // Cek apakah ada file foto yang di-upload
        if ($request->hasFile('foto')) {
            // Ambil nama file foto lama dari database
            $oldFilename = $user->foto;

            // Hapus foto lama jika ada
            if ($oldFilename) {
                $oldFilePath = public_path('storage/uploads/' . $oldFilename);
                // Cek apakah file lama ada dan hapus
                if (file_exists($oldFilePath)) {
                    unlink($oldFilePath); // Hapus foto lama dari folder
                }
            }

            // Simpan file baru dengan storeAs
            $file = $request->file('foto');
            $newFilename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('uploads', $newFilename, 'public'); // Simpan ke folder storage/public/uploads

            // Update nama file di database
            $user->foto = $newFilename;
        }

        // Simpan perubahan pada user
        $user->save();

        return redirect()->route('user.list')->with('success', 'User Berhasil di Update');
    }

    public function destroy($id)
    {
        $user = UserModel::findOrFail($id);
        $user->delete();

        return redirect()->to('/')->with('success', 'User Berhasil di Hapus');
    }

    public function show($id)
    {

        $user = UserModel::findOrFail($id);
        $kelas = Kelas::find($user->kelas_id); // Jika ingin menampilkan nama kelas

        return view('profile', [
            'title' => 'Show User',
            'user' => $user,
            'nama_kelas' => $kelas ? $kelas->nama_kelas : null, // Pastikan nama kelas ada, jika tidak tampilkan null
        ]);
    }
}
