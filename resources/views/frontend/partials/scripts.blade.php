<script src="{{ asset('frontend.js') }}?v={{ filemtime(public_path('frontend.js')) }}" defer></script>
@stack('scripts')
