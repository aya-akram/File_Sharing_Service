



<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>File share service</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <style>
 #ww {
            margin-top: 50px;
        }
        h2 {
            color: black;
        }
    </style>
</head>

<body>
<div class="container" id="ww">
<h2>Download All Files</h2>

<table class="table table-success table-striped">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Link File</th>
      <th scope="col">Description File</th>

    </tr>
  </thead>
  <tbody>

    @foreach($files as $file)
                <tr>
                    <th scope="row">{{ $file->id }}</th>
                    <td><a href="{{ route('file.download', ['uuid' => $file->uuid]) }}">{{ route('file.download', ['uuid' => $file->uuid]) }}</a></td>
                    <td>{{ $file->title }}</td>
                </tr>
                @endforeach



  </tbody>
</table>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>
