@extends('layouts.app')

@section('content')

    <div id="app">
        <new-image></new-image>
    </div>

@endsection

@section('script')
<script>
    $(window ).on('load', function() {
        $.get("https://ipinfo.io", function() {}, "jsonp").always(function(resp) {
            var latlng = resp.loc.split(',');
            $('input#latitude').val(latlng[0]);
            $('input#longitude').val(latlng[1]);
        });
    });
</script>
@endsection