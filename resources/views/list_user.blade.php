@extends('layouts.app')

@section('content')
    <head>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
        <style>
            body {
                font-family: 'Poppins', sans-serif;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
                margin: 0;
                background-color: #E75480; /* Warna Lotso */
            }

            .container {
                width: 90%;
                background-color: rgba(255, 255, 255, 0.9);
                padding: 20px;
                border-radius: 15px;
                box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            }

            .btn-success {
                background-color: #8B0000; /* Warna merah tua */
                color: white;
                border: none;
                padding: 8px 15px;
                border-radius: 8px;
                font-weight: 500;
            }

            .btn-success:hover {
                background-color: #6A0D0D;
            }

            .table thead {
                background-color: #FFD1DC; /* Warna pink pastel */
            }

            .table-hover tbody tr:hover {
                background-color: #ffe6eb; /* Warna pink lembut */
            }

            .btn-info {
                background-color: #5BC0DE;
                color: white;
            }

            .btn-warning {
                background-color: #FFC107;
                color: white;
            }

            .btn-danger {
                background-color: #DC3545;
                color: white;
            }

            .action-buttons .btn {
                margin: 0 2px;
            }
        </style>
    </head>
    
    <div class="container mt-4">
        <div class="d-flex justify-content-end mb-3">
            <a href="{{ route('user.create') }}" class="btn btn-success">Tambah Pengguna Baru</a>
        </div>

        <div class="table-responsive">
            <table class="table table-hover table-bordered text-center">
                <thead class="table-secondary">
                    <tr>
                        <th scope="col"><b>ID</b></th>
                        <th scope="col"><b>Nama</b></th>
                        <th scope="col"><b>NPM</b></th>
                        <th scope="col"><b>Kelas</b></th>
                        <th scope="col"><b>Fakultas</b></th>
                        <th scope="col"><b>Aksi</b></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user['id'] }}</td>
                            <td>{{ $user['nama'] }}</td>
                            <td>{{ $user['npm'] }}</td>
                            <td>{{ $user['nama_kelas'] }}</td>
                            <td>{{ $user->nama_fakultas }}</td>
                            <td>
                                <div class="action-buttons">
                                    <a href="{{ route('user.show', $user->id) }}" class="btn btn-info btn-sm">View</a>
                                    <a href="{{ route('user.edit', $user->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('user.destroy', $user->id) }}" method="POST"
                                        style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus user ini?')">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
