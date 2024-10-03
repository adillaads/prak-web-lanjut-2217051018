<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/create.css">
    <title>Form</title>
</head>
<body>

    <div class="container">
        <h1 class="text-center">Silahkan Isi Data</h1>
        <div class="row align-items-center">
            <div class="col-md-6">
                <img src="/assets/img/cat.jpg" alt="Cat Image" class="img-fluid">
            </div>
            <div class="col-md-6">
                <form action="{{ route('user.store') }}" method='post'>
                    @csrf
                    <div class="form-group">
                        <label for="nama">Nama:</label>
                        <input type="text" id="nama" name="nama" class="form-control">
                        @foreach ($errors->get('nama') as $msg)
                    <p class="text-danger">{{ $msg }}</p>
                @endforeach
                    </div>

                    <div class="form-group">
                        <label for="npm">NPM:</label>
                        <input type="text" id="npm" name="npm" class="form-control">
                        @foreach ($errors->get('npm') as $msg)
                    <p class="text-danger">{{ $msg }}</p>
                @endforeach
                    </div>

                    <div class="form-group">
                        <label for="id_kelas">Kelas:</label><br>
                        <select name="kelas_id" id="kelas_id" required>
                            @foreach($kelas as $kelasItem)
                            <option value="{{$kelasItem->id}}">{{$kelasItem->nama_kelas}}</option>
                            @endforeach
            </select>
                    </div>
                    <input type="submit" value="Submit" class="btn btn-primary btn-block">
                </form>
            </div>
        </div>
    </div>

</body>
</html>
