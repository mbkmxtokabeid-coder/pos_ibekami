<script type="module" src="{{asset('js/notif.js')}}?v={{ file_exists(public_path('js/notif.js')) ? filemtime(public_path('js/notif.js')) : '20261120' }}"></script>
<script src="{{asset('libs/bootstrap/js/bootstrap.bundle.min.js')}}" defer></script>
<script src="{{asset('libs/simplebar/simplebar.min.js')}}" defer></script>
<script src="{{asset('libs/node-waves/waves.min.js')}}" defer></script>
<script src="{{asset('libs/feather-icons/feather.min.js')}}" defer></script>
<script src="{{asset('js/plugins.js')}}" defer></script>

@yield('plugins')
<!-- App js -->
<script src="{{asset('js/app.js')}}?v={{ file_exists(public_path('js/app.js')) ? filemtime(public_path('js/app.js')) : '20261120' }}" defer></script>

