
@if($message = Session::get('success'))
    <script>
        toastr.success( '{{$message}}', 'Success Alert', {timeOut: 5000});
    </script>
    @php( Session::forget('success'))
@endif

@if($message = Session::get('error'))
    <script>
        toastr.success( '{{$message}}', 'Error Alert', {timeOut: 5000});
    </script>
    @php( Session::forget('error'))
@endif

@if($message = Session::get('error'))
    <script>
        toastr.success( '{{$message}}', 'Error Alert', {timeOut: 5000});
    </script>
    @php( Session::forget('error'))
@endif

@if($message = Session::get('error'))
    <script>
        toastr.success( '{{$message}}', 'Error Alert', {timeOut: 5000});
    </script>
    @php( Session::forget('error'))
@endif

@if($message = Session::get('error'))
    <script>
        toastr.success( '{{$message}}', 'Error Alert', {timeOut: 5000});
    </script>
    @php( Session::forget('error'))
@endif