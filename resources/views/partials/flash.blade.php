{{-- Flash message --}}
@if($flash = session('message'))
    <div class="container flash">
        <div class="col s12">{{$flash}}</div>
    </div>
@endif