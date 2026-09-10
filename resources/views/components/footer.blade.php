@php
    $quickLinks = [
        ['label' => 'Home', 'href' => '#top'],
        ['label' => 'Features', 'href' => '#features'],
        ['label' => 'The shop', 'href' => '#showcase'],
        ['label' => 'Memberships', 'href' => '#pricing'],
        ['label' => 'Reviews', 'href' => '#testimonials'],
        ['label' => 'Book a chair', 'href' => '#contact'],
    ];
    $socials = [
        ['label' => 'Instagram', 'icon' => 'instagram', 'href' => 'https://instagram.com'],
        ['label' => 'Facebook', 'icon' => 'facebook', 'href' => 'https://facebook.com'],
        ['label' => 'TikTok', 'icon' => 'tiktok', 'href' => 'https://tiktok.com'],
    ];
@endphp

<footer class="border-t border-inverse-line bg-inverse text-on-inverse">
    <div class="mx-auto max-w-7xl px-6 py-16 lg:px-8">
        <div class="grid gap-12 md:grid-cols-2 lg:grid-cols-[1.4fr_1fr_1fr]">
            {{-- Company --}}
            <div>
                <div class="flex items-center gap-2.5">
                    <span class="flex h-9 w-9 items-center justify-center rounded-full bg-on-inverse text-inverse">
                        <x-icon name="scissors" class="h-5 w-5" />
                    </span>
                    <span class="font-display text-2xl leading-none tracking-wide">Fadehouse Barber Co.</span>
                </div>
                <p class="mt-4 max-w-xs text-sm leading-relaxed text-inverse-muted">
                    A grooming studio for people who would rather book than wait. Cuts, beards, and
                    straight-razor finishes on Katipunan Ave since 2016.
                </p>
                <div class="mt-5 flex gap-2">
                    @foreach ($socials as $social)
                        <a href="{{ $social['href'] }}" target="_blank" rel="noopener noreferrer"
                           aria-label="Fadehouse on {{ $social['label'] }}"
                           class="flex h-10 w-10 items-center justify-center rounded-full border border-inverse-line
                                  text-inverse-muted transition-colors hover:border-on-inverse hover:text-on-inverse">
                            <x-icon :name="$social['icon']" class="h-5 w-5" />
                        </a>
                    @endforeach
                </div>
            </div>

            {{-- Quick links --}}
            <nav aria-label="Footer">
                <h2 class="text-xs font-semibold uppercase tracking-[0.2em] text-inverse-muted">Quick links</h2>
                <ul class="mt-4 space-y-2.5 text-sm">
                    @foreach ($quickLinks as $link)
                        <li>
                            <a href="{{ $link['href'] }}"
                               class="text-on-inverse/80 transition-colors hover:text-on-inverse">{{ $link['label'] }}</a>
                        </li>
                    @endforeach
                </ul>
            </nav>

            {{-- Contact --}}
            <div>
                <h2 class="text-xs font-semibold uppercase tracking-[0.2em] text-inverse-muted">Find us</h2>
                <address class="mt-4 space-y-3 text-sm not-italic text-on-inverse/80">
                    <span class="flex gap-3">
                        <x-icon name="map-pin" class="mt-0.5 h-4 w-4 shrink-0 text-inverse-muted" />
                        112 Katipunan Ave, Blue Ridge A,<br>Quezon City, 1109
                    </span>
                    <a href="tel:+639174428813" class="flex gap-3 transition-colors hover:text-on-inverse">
                        <x-icon name="phone" class="mt-0.5 h-4 w-4 shrink-0 text-inverse-muted" />
                        +63 917 442 8813
                    </a>
                    <span class="flex gap-3">
                        <x-icon name="clock" class="mt-0.5 h-4 w-4 shrink-0 text-inverse-muted" />
                        Tue to Sun, 10am to 8pm<br>Closed Mondays
                    </span>
                </address>
            </div>
        </div>

        <div class="mt-14 flex flex-col gap-3 border-t border-inverse-line pt-6 text-xs text-inverse-muted
                    sm:flex-row sm:items-center sm:justify-between">
            <p>&copy; {{ date('Y') }} Fadehouse Barber Co. All rights reserved.</p>
            <p class="flex gap-5">
                <a href="#" class="transition-colors hover:text-on-inverse">Privacy</a>
                <a href="#" class="transition-colors hover:text-on-inverse">Terms</a>
                <a href="#" class="transition-colors hover:text-on-inverse">Careers</a>
            </p>
        </div>
    </div>
</footer>
