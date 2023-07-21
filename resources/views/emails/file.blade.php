<!DOCTYPE html>
<html>
<body>
    <h1>{{ $title }}</h1>
    <p>You can download the file from the following link: <a href="{{route('file.share', $file_id)}}">Download</a></p>
</body>
</html>
