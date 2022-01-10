<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="{{route('upload')}}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="file" name="file" id="file">
        <br>
        <button type="submit" style="margin-top:5px">Enviar</button>
    </form>

    <table>
        <tr>
            <td>Arquivo</td>
            <td>Ação</td>
        </tr>
        @foreach($files as $row)
        <tr>
            <td>
                {{$row}}
            </td>
            <td>

                <a href="{{route('download', base64_encode($row))}}">Download</a>
            </td>
        </tr>
            @endforeach
    </table>

    @if(session('success'))
        <h4>{{session('sucess')}}</h4>
    @endif

</body>
</html>