<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data Anggota</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container text-center p-4">
        <h1 class="mb-3">Data Anggota</h1>
        <div class="row">
            <div class="m-auto">
                <ol class="list-group">
                    @forelse ($anggotas as $item)
                        <li class="list-group-item">
                            {{$item->nama}} {{$item->nip}},
                            Tanggal Lahir : {{$item->tanggal_lahir}},
                            Nilai : {{$item->nilai}}
                        </li>
                    @empty
                        <div class="alert alert-dark d-inline-block">Tidak ada data...</div>
                    @endforelse
                </ol>
            </div>
        </div>
    </div>    
</body>
</html>