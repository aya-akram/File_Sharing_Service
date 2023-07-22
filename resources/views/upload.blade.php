<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>File share service</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <style>
        div {
            flex-wrap: wrap;
            align-items: center;
            align-content: center;
        }

        #ee {
            margin-top: 50px;
        }

        #ww {
            margin-top: 50px;
        }

        h1 {
            color: blue;
        }

        label {
            color: blueviolet;
        }
    </style>
</head>

<body>

    <div class="container" id="ww">
        <h1>File Sharing Service</h1>
        <form action="{{ route('file.upload') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="col-md-6" id="ee">
                @if(session('success'))
                <div class="alert alert-success">
                    {{session('success')}}
                </div>
                @endif
            </div>
            <div class="col-md-6" id="ee">
                <div class="mb-3">
                    <label for="file">Choose a file:</label>
                    <input type="file" id="file" name="file" class="form-control">
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label for="formFile" class="form-label">Email to:</label>
                    <input class="form-control" type="email" name="email_to">
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label for="formFile" class="form-label">Your Email:</label>
                    <input class="form-control" type="email" name="email_from">
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="formFile" class="form-label">Title:</label>
                    <input class="form-control" type="text" name="title">
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Upload</button>
           <a href="{{route('file.show')}}" class="btn btn-sm btn-success">Downloade File</a>



            @if(Session::has('download_link'))

            <div class="row">
                <div class="col-md-4">
                    <p>Your download link: <a href="{{ Session::get('download_link') }}">{{ Session::get('download_link') }}</a></p>
                </div>
            </div>
            @endif





        </form>

    </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>
