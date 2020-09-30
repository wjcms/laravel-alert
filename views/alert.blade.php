@if(Session::has('alerts'))
<link rel="stylesheet" href="/alert/toast.css ">
<script src="https://cdn.bootcdn.net/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="/alert/toast.min.js"></script>
<script type="text/javascript">
    toastr.options = {
        "closeButton": true,
        "newestOnTop": true,
        "progressBar": true,
        "timeOut": 3000,
        "positionClass": "toast-top-center"
    };

    @foreach(Session::get('alerts') as $alert)
    toastr["{{ $alert['type'] }}"]("{{ $alert['message'] }}");
    @endforeach

</script>
@endif