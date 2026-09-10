@props([
    'eyebrow' => 'Katipunan Ave · Quezon City',
    'title' => 'Great cuts, zero waiting.',
    'description' => 'Book a master barber on Katipunan in about 30 seconds. You are in the chair on time, every visit.',
    'image' => null,
])

<section id="top" class="relative overflow-hidden">
    <div class="mx-auto grid max-w-7xl items-center gap-12 px-6 pb-16 pt-14 lg:grid-cols-[1.05fr_0.95fr]
                lg:gap-16 lg:px-8 lg:pb-24 lg:pt-20">
        {{-- Copy --}}
        <div class="reveal max-w-xl">
            <div class="mb-6 flex items-center gap-3">
                <span class="h-px w-8 bg-accent"></span>
                <span class="text-xs font-semibold uppercase tracking-[0.22em] text-accent">{{ $eyebrow }}</span>
            </div>

            <h1 class="font-display text-[2.75rem] uppercase leading-[0.9] text-ink sm:text-6xl lg:text-[5.25rem]">
                {{ $title }}
            </h1>

            <p class="mt-6 max-w-md text-lg leading-relaxed text-muted">
                {{ $description }}
            </p>

            <div class="mt-9 flex flex-col gap-3 sm:flex-row sm:items-center">
                <x-button href="#contact" variant="primary" size="lg" icon="arrow-right">Book a chair</x-button>
                <x-button href="#features" variant="outline" size="lg">See how it works</x-button>
            </div>
        </div>

        {{-- Asset --}}
        <div class="reveal relative" style="--reveal-delay: 120ms">
            <div class="relative aspect-[7/8] overflow-hidden rounded-2xl border border-line bg-surface-2">
                <img src="{{ $image ?? asset('images/hero-barber.jpg') }}" width="1200" height="800"
                     alt="A barber giving a straight-razor beard trim at Fadehouse."
                     fetchpriority="high" decoding="async"
                     class="h-full w-full object-cover" />
            </div>
            {{-- Offset accent block for asymmetry, purely decorative --}}
            <div aria-hidden="true"
                 class="absolute -bottom-5 -left-5 -z-10 hidden h-40 w-40 rounded-2xl bg-accent/15 lg:block"></div>
        </div>
    </div>

    {{-- Trust strip -- lives UNDER the hero copy, not inside it --}}
    <div class="border-y border-line bg-surface/60">
        <dl class="mx-auto grid max-w-7xl grid-cols-2 divide-x divide-line px-6 sm:grid-cols-4 lg:px-8">
            @foreach ([
                ['k' => '9 yrs', 'v' => 'on Katipunan'],
                ['k' => '6', 'v' => 'master barbers'],
                ['k' => '4.9', 'v' => 'from 1,240 reviews'],
                ['k' => '~4 min', 'v' => 'average wait, booked'],
            ] as $stat)
                <div class="px-4 py-6 text-center sm:py-7">
                    <dt class="font-display text-3xl text-ink sm:text-4xl">{{ $stat['k'] }}</dt>
                    <dd class="mt-1 text-xs font-medium uppercase tracking-wider text-muted">{{ $stat['v'] }}</dd>
                </div>
            @endforeach
        </dl>
    </div>
</section>
