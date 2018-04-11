@if (isset($anaKey) && $anaKey != '')
    <!-- klaravel::_parts.analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id={{$anaKey}}"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', '{{$anaKey}}');
    </script>
@endif
