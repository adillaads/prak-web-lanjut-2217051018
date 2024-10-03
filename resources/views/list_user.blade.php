@extends('layouts.app')

@section ('content')
<head>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
</head>

<style>
    body {
        font-family: 'Poppins', sans-serif;
        background-color: #f8f9fa;
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
    }

    /* Button styling */
    .btn-success {
        background-color: #28a745;
        color: white;
        padding: 12px 24px;
        border: none;
        border-radius: 6px;
        font-size: 16px;
        font-weight: 600;
        text-transform: uppercase;
        transition: background-color 0.3s ease, transform 0.3s ease;
    }

    .btn-success:hover {
        background-color: #218838;
        transform: translateY(-3px);
    }

    /* Table styling */
    .table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 30px;
        background-color: white;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
        overflow: hidden;
    }

    .table th, .table td {
        padding: 15px;
        text-align: left;
        border: 1px solid #e9ecef;
    }

    .table th {
        background-color: #f1f3f5;
        color: #495057;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    .table tbody tr:nth-child(even) {
        background-color: #f8f9fa;
    }

    .table tbody tr:hover {
        background-color: #f1f3f5;
        cursor: pointer;
    }

    .table-group-divider {
        border-top: 3px solid #dee2e6;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .table {
            font-size: 14px;
        }

        .btn-success {
            font-size: 14px;
            padding: 10px 20px;
        }
    }
</style>


<div class="container">
    <div class="mb-3 mt-2 m-3">
        <a href="{{ route('user.create') }}" class="btn btn-success">Tambah User</a>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nama</th>
                <th scope="col">NPM</th>
                <th scope="col">Kelas</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            <?php
              foreach ($users as $user) {
            ?>
            <tr>
                <td><?= $user['id'] ?></td>
                <td><?= $user['nama'] ?></td>
                <td><?= $user['npm'] ?></td>
                <td><?= $user['nama_kelas'] ?></td>
                <td></td>
            </tr>
            <?php
              }
            ?>
        </tbody>
    </table>
</div>
@endsection
