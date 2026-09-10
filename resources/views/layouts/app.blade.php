<!DOCTYPE html>
<html lang="en" class="scroll-pt-24">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#faf9f7" media="(prefers-color-scheme: light)">
    <meta name="theme-color" content="#141310" media="(prefers-color-scheme: dark)">

    <title>@yield('title', 'Fadehouse Barber Co. | Sharp cuts, no waiting, in Quezon City')</title>
    <meta name="description"
          content="Fadehouse is a grooming studio on Katipunan Ave. Book a master barber in 30 seconds, skip the wait, and walk out sharp. Memberships from ₱850 a month.">

    {{-- Set the theme before first paint to avoid a flash of the wrong colours. --}}
    <script>
        (function () {
            try {
                var saved = localStorage.getItem('fh-theme');
                if (saved === 'light' || saved === 'dark') {
                    document.documentElement.dataset.theme = saved;
                }
            } catch (e) {}
        })();
    </script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-dvh antialiased">
    <a href="#main"
       class="sr-only focus:not-sr-only focus:absolute focus:left-4 focus:top-4 focus:z-[100]
              focus:rounded-full focus:bg-ink focus:px-5 focus:py-2 focus:text-sm focus:font-semibold
              focus:text-bg">
        Skip to content
    </a>

    <div data-nav-sentinel aria-hidden="true" class="absolute inset-x-0 top-0 h-px"></div>

    @yield('content')
</body>
</html>
