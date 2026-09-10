@php
    $links = [
        ['label' => 'Home', 'href' => '#top'],
        ['label' => 'Features', 'href' => '#features'],
        ['label' => 'Pricing', 'href' => '#pricing'],
        ['label' => 'Testimonials', 'href' => '#testimonials'],
        ['label' => 'Contact', 'href' => '#contact'],
    ];
@endphp

<header data-nav
        class="sticky top-0 z-50 border-b border-transparent bg-bg/80 backdrop-blur-md transition-colors
               duration-300 data-[scrolled]:border-line data-[scrolled]:bg-bg/95">
    <nav class="mx-auto flex h-[72px] max-w-7xl items-center justify-between gap-6 px-6 lg:px-8"
         aria-label="Primary">
        {{-- Logo --}}
        <a href="#top" class="flex items-center gap-2.5 text-ink" aria-label="Fadehouse Barber Co. home">
            <span class="flex h-9 w-9 items-center justify-center rounded-full bg-ink text-bg">
                <x-icon name="scissors" class="h-5 w-5" />
            </span>
            <span class="font-display text-2xl leading-none tracking-wide">Fadehouse</span>
        </a>

        {{-- Desktop links --}}
        <ul class="hidden items-center gap-8 lg:flex">
            @foreach ($links as $link)
                <li>
                    <a href="{{ $link['href'] }}"
                       class="text-sm font-medium text-muted transition-colors hover:text-ink">
                        {{ $link['label'] }}
                    </a>
                </li>
            @endforeach
        </ul>

        {{-- Desktop actions --}}
        <div class="hidden items-center gap-2 lg:flex">
            <button type="button" data-theme-toggle
                    class="flex h-10 w-10 items-center justify-center rounded-full text-muted transition-colors
                           hover:bg-ink/[0.06] hover:text-ink focus-visible:outline-2 focus-visible:outline-offset-2
                           focus-visible:outline-accent"
                    aria-label="Switch theme">
                <x-icon name="sun" class="hidden h-5 w-5 dark:block" />
                <x-icon name="moon" class="h-5 w-5 dark:hidden" />
            </button>
            <x-button href="#contact" variant="ghost" size="sm">Sign in</x-button>
            <x-button href="#pricing" variant="primary" size="sm" icon="arrow-right">Book a chair</x-button>
        </div>

        {{-- Mobile toggle --}}
        <button type="button" data-nav-toggle aria-expanded="false" aria-controls="mobile-nav"
                class="flex h-10 w-10 items-center justify-center rounded-full text-ink transition-colors
                       hover:bg-ink/[0.06] lg:hidden focus-visible:outline-2 focus-visible:outline-offset-2
                       focus-visible:outline-accent">
            <span class="sr-only">Toggle menu</span>
            <x-icon name="list" class="h-6 w-6" />
        </button>
    </nav>

    {{-- Mobile panel --}}
    <div id="mobile-nav" data-nav-panel hidden
         class="border-t border-line bg-bg lg:hidden">
        <div class="space-y-1 px-6 py-4">
            @foreach ($links as $link)
                <a href="{{ $link['href'] }}"
                   class="block rounded-xl px-3 py-3 text-base font-medium text-ink transition-colors hover:bg-ink/[0.05]">
                    {{ $link['label'] }}
                </a>
            @endforeach
            <div class="flex flex-col gap-2 pt-3">
                <x-button href="#pricing" variant="primary" size="md" icon="arrow-right">Book a chair</x-button>
                <x-button href="#contact" variant="outline" size="md">Sign in</x-button>
            </div>
            <button type="button" data-theme-toggle
                    class="mt-2 flex w-full items-center justify-center gap-2 rounded-xl px-3 py-3 text-sm
                           font-medium text-muted transition-colors hover:bg-ink/[0.05] hover:text-ink">
                <x-icon name="moon" class="h-4 w-4 dark:hidden" />
                <x-icon name="sun" class="hidden h-4 w-4 dark:block" />
                Toggle light / dark
            </button>
        </div>
    </div>
</header>
