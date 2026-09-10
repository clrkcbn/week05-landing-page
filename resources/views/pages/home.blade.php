@extends('layouts.app')

@php
    $features = [
        [
            'icon' => 'scissors',
            'title' => 'Barbers who train',
            'description' => 'Everyone on the floor has five years in and sits a technique clinic every month. No apprentices practising on you.',
            'tone' => 'accent',
        ],
        [
            'icon' => 'calendar-check',
            'title' => 'Book in 30 seconds',
            'description' => 'Pick a barber, pick a slot, done. No calls, no DMs left on read, no "we will confirm later".',
        ],
        [
            'icon' => 'clock',
            'title' => 'On-time guarantee',
            'description' => 'Booked for 3:00? You are gowned up by 3:05 or the haircut is on the house. We track it.',
        ],
        [
            'icon' => 'spray-bottle',
            'title' => 'Hot-towel finish',
            'description' => 'Every cut closes with a straight-razor neck line-up and a hot towel. Standard, not an upsell.',
        ],
        [
            'icon' => 'hand-soap',
            'title' => 'Beard and skin care',
            'description' => 'Licensed beard sculpting plus a quick skin read, using the same products we stock on the shelf.',
        ],
        [
            'icon' => 'shield-check',
            'title' => 'Seven-day reshape',
            'description' => 'Grows out weird or sat wrong? Come back within a week and we fix it, no charge, no debate.',
            'tone' => 'accent',
        ],
    ];

    $plans = [
        [
            'name' => 'The Regular',
            'priceMonthly' => 850,
            'blurb' => 'For the once-a-fortnight crowd who just want it easy.',
            'features' => [
                'Two haircuts a month',
                'Online booking with your pick of barber',
                'On-time guarantee',
                '10% off shelf products',
                'Roll over one unused cut',
            ],
            'cta' => 'Choose The Regular',
        ],
        [
            'name' => 'The Sharp',
            'priceMonthly' => 1450,
            'blurb' => 'Tight fades, kept tight. Our most-booked plan.',
            'features' => [
                'Four haircuts a month',
                'Beard trim on every visit',
                'Priority weekend slots',
                'Free reshape within 7 days',
                '15% off shelf products',
            ],
            'featured' => true,
            'cta' => 'Choose The Sharp',
        ],
        [
            'name' => 'The Full Kit',
            'priceMonthly' => 2600,
            'blurb' => 'Unlimited chair time and a standing appointment.',
            'features' => [
                'Unlimited haircuts',
                'Beard sculpt and line-up',
                'One straight-razor shave a month',
                'Home grooming kit each quarter',
                'Bring-a-friend pass monthly',
                '25% off shelf products',
            ],
            'cta' => 'Choose The Full Kit',
        ],
    ];

    $testimonials = [
        [
            'quote' => 'I have been to every barber on Katipunan. This is the first one where 3pm actually means 3pm. Booked on the app, walked in, sat down.',
            'name' => 'Miguel Andrada',
            'position' => 'Product lead, Ketsu',
            'photo' => asset('images/person-1.jpg'),
        ],
        [
            'quote' => 'Asked for something between a crop and a mullet with zero reference photos. Jomar figured it out and it has held its shape for three weeks.',
            'name' => 'Paolo Rivera',
            'position' => 'Live sound engineer',
            'photo' => asset('images/person-2.jpg'),
        ],
        [
            'quote' => 'The Sharp plan pays for itself if you like your fade clean. Weekend slots are easy to get and the beard trim every visit is the part I did not know I needed.',
            'name' => 'Denise Yatco',
            'position' => 'Brand manager',
            'photo' => asset('images/person-3.jpg'),
        ],
    ];
@endphp

@section('content')
    <x-navbar />

    <main id="main">
        <x-hero />

        {{-- Features ------------------------------------------------------ --}}
        <section id="features" class="py-20 lg:py-28">
            <div class="mx-auto max-w-7xl px-6 lg:px-8">
                <x-section-heading
                    title="Six reasons people rebook"
                    intro="Not a loyalty gimmick. Just the things that were annoying everywhere else, fixed." />

                <div class="mt-14 grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($features as $i => $feature)
                        <x-feature-card
                            :icon="$feature['icon']"
                            :title="$feature['title']"
                            :description="$feature['description']"
                            :tone="$feature['tone'] ?? 'default'"
                            style="--reveal-delay: {{ ($i % 3) * 80 }}ms" />
                    @endforeach
                </div>
            </div>
        </section>

        <x-showcase />

        {{-- Pricing ------------------------------------------------------- --}}
        <section id="pricing" class="py-20 lg:py-28">
            <div class="mx-auto max-w-7xl px-6 lg:px-8">
                <div class="flex flex-col gap-8 lg:flex-row lg:items-end lg:justify-between">
                    <x-section-heading
                        title="Memberships, not punch cards"
                        intro="Pay monthly, cancel anytime, no lock-in. Annual takes two months off the price." />

                    {{-- Billing switch --}}
                    <div class="flex items-center gap-3">
                        <span data-billing-label="monthly" class="text-sm font-semibold text-ink">Monthly</span>
                        <label class="relative inline-flex cursor-pointer items-center">
                            <input type="checkbox" data-billing-switch class="peer sr-only" />
                            <span class="h-6 w-11 rounded-full bg-line transition-colors peer-checked:bg-accent
                                         peer-focus-visible:outline-2 peer-focus-visible:outline-offset-2
                                         peer-focus-visible:outline-accent"></span>
                            <span class="absolute left-0.5 h-5 w-5 rounded-full bg-surface shadow transition-transform
                                         peer-checked:translate-x-5"></span>
                            <span class="sr-only">Bill annually</span>
                        </label>
                        <span data-billing-label="annual" class="text-sm font-semibold text-muted">
                            Annual <span class="text-accent">&middot; 2 months free</span>
                        </span>
                    </div>
                </div>

                <div class="mt-14 grid gap-6 lg:grid-cols-3">
                    @foreach ($plans as $plan)
                        <x-pricing-card
                            :name="$plan['name']"
                            :price-monthly="$plan['priceMonthly']"
                            :blurb="$plan['blurb']"
                            :features="$plan['features']"
                            :featured="$plan['featured'] ?? false"
                            :cta="$plan['cta']" />
                    @endforeach
                </div>

                <p class="mt-6 text-center text-sm text-muted">
                    Single cuts without a plan start at ₱450. Students knock 15% off any plan with an ID.
                </p>
            </div>
        </section>

        {{-- Testimonials ------------------------------------------------- --}}
        <section id="testimonials" class="border-t border-line bg-surface/40 py-20 lg:py-28">
            <div class="mx-auto max-w-7xl px-6 lg:px-8">
                <x-section-heading
                    title="What regulars say"
                    align="center"
                    class="mx-auto" />

                <div class="mt-14 grid gap-6 md:grid-cols-3">
                    @foreach ($testimonials as $i => $t)
                        <x-testimonial-card
                            :quote="$t['quote']"
                            :name="$t['name']"
                            :position="$t['position']"
                            :photo="$t['photo']"
                            style="--reveal-delay: {{ $i * 90 }}ms" />
                    @endforeach
                </div>
            </div>
        </section>

        <x-contact />

        <x-cta />
    </main>

    <x-footer />
@endsection
