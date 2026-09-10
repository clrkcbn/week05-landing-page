@props([
    'wideImage' => null,
    'detailImage' => null,
    'phoneImage' => null,
])

@php
    $highlights = [
        ['title' => '6 chairs, never double-booked', 'body' => 'Every slot is a real slot. Your barber is free when the app says they are.'],
        ['title' => 'Walk-ins welcome before noon', 'body' => 'Mornings are first-come. Afternoons and weekends run on bookings.'],
        ['title' => 'Open Tuesday to Sunday, 10-8', 'body' => 'Closed Mondays. Last booking goes out at 7:15pm.'],
        ['title' => 'Parking and coffee on the house', 'body' => 'Free lot behind the building. Barako or cold brew while you wait.'],
    ];
@endphp

<section id="showcase" class="border-t border-line bg-surface/40 py-20 lg:py-28">
    <div class="mx-auto max-w-7xl px-6 lg:px-8">
        <x-section-heading
            title="Look around before you come in"
            intro="This is the room you are booking into: the floor, the tools, and the booking screen you will actually use." />

        <div class="mt-14 grid gap-6 lg:grid-cols-12">
            {{-- Wide "screenshot" of the space --}}
            <figure class="reveal lg:col-span-8">
                <div class="overflow-hidden rounded-2xl border border-line bg-surface-2">
                    <img src="{{ $wideImage ?? asset('images/shop-floor.jpg') }}" width="1280" height="960" loading="lazy" decoding="async"
                         alt="The Fadehouse floor: six barber stations under warm pendant light."
                         class="h-full w-full object-cover" />
                </div>
                <figcaption class="mt-3 text-sm text-muted">The floor on a Saturday afternoon.</figcaption>
            </figure>

            {{-- Phone / mobile view --}}
            <figure class="reveal lg:col-span-4" style="--reveal-delay: 100ms">
                <div class="mx-auto w-[220px] rounded-[2rem] border-[6px] border-ink bg-ink p-1.5 shadow-xl">
                    <div class="overflow-hidden rounded-[1.6rem] bg-surface-2">
                        <img src="{{ $phoneImage ?? asset('images/lineup-portrait.jpg') }}" width="640" height="1280" loading="lazy" decoding="async"
                             alt="A barber finishing a neck line-up, viewed on a phone-sized crop."
                             class="aspect-[9/18] h-full w-full object-cover" />
                    </div>
                </div>
                <figcaption class="mt-3 text-center text-sm text-muted">Booking takes about 30 seconds on a phone.</figcaption>
            </figure>

            {{-- Detail image --}}
            <figure class="reveal lg:col-span-5">
                <div class="overflow-hidden rounded-2xl border border-line bg-surface-2">
                    <img src="{{ $detailImage ?? asset('images/barber-chair.jpg') }}" width="720" height="720" loading="lazy" decoding="async"
                         alt="A classic tufted-leather barber chair at a Fadehouse station."
                         class="aspect-[4/3] h-full w-full object-cover" />
                </div>
            </figure>

            {{-- Key highlights --}}
            <div class="reveal lg:col-span-7" style="--reveal-delay: 80ms">
                <h3 class="font-display text-2xl uppercase tracking-wide text-ink">The short version</h3>
                <dl class="mt-4 divide-y divide-line border-y border-line">
                    @foreach ($highlights as $item)
                        <div class="flex gap-4 py-4">
                            <span class="mt-0.5 flex h-6 w-6 shrink-0 items-center justify-center rounded-full
                                         bg-accent/15 text-accent">
                                <x-icon name="check" class="h-4 w-4" />
                            </span>
                            <div>
                                <dt class="font-semibold text-ink">{{ $item['title'] }}</dt>
                                <dd class="mt-0.5 text-[15px] leading-relaxed text-muted">{{ $item['body'] }}</dd>
                            </div>
                        </div>
                    @endforeach
                </dl>
            </div>
        </div>
    </div>
</section>
