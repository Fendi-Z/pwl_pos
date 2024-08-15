<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ORM</title>
</head>
<body>
    <h1>Data Level Pengguna</h1>
    <table border="1" cellpadding="2" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Nama</th>
            <th>ID Level Pengguna</th>
            <th>Kode Level</th>
            <th>Nama Level</th>
        </tr>
        @foreach ($data as $item)
        <tr>
            <td>{{$item->user_id}}</td>
            <td>{{$item->username}}</td>
            <td>{{$item->nama}}</td>
            <td>{{$item->level_id}}</td>
            <td>{{$item->level->level_kode}}</td>
            <td>{{$item->level->level_nama}}</td>
        </tr>
        @endforeach
    </table>
</body>
</html>