<!DOCTYPE html>
<html>
<head>
    <title></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <style>
        /* Your custom CSS styles here */
    </style>
</head>
<body>

<!-- Your HTML content here -->

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

@if(session()->has('success'))
    <script>
        $(document).ready(function() {
            toastr.success('{{ session('success') }}', '', { timeOut: 10000 });
        });
    </script>
@endif

@if($errors->any())
    <script>
        $(document).ready(function() {
            toastr.error('Errors occurred:');
            @foreach ($errors->all() as $error)
                toastr.error('{{ $error }}');
            @endforeach
        });
    </script>
@endif

</body>
</html>
