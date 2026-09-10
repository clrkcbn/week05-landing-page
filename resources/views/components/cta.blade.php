@props([
    'phone' => '+63 917 442 8813',
    'phoneHref' => 'tel:+639174428813',
])

<section id="visit" class="bg-inverse text-on-inverse">
    <div class="mx-auto max-w-7xl px-6 py-20 lg:px-8 lg:py-28">
        <div class="reveal grid gap-10 lg:grid-cols-[1.4fr_0.6fr] lg:items-end">
            <div>
                <h2 class="max-w-2xl font-display text-5xl uppercase leading-[0.95] sm:text-6xl">
                    Your best haircut is one booking away
                </h2>
                <p class="mt-6 max-w-md text-lg leading-relaxed text-inverse-muted">
                    First visit? Tell your barber what you are growing out and where you want to land.
                    They will take it from there.
                </p>
            </div>

            <div class="flex flex-col gap-3 sm:flex-row lg:flex-col lg:items-end">
                <x-button href="#contact" variant="primary" size="lg" icon="arrow-right"
                          class="w-full sm:w-auto">Book a chair</x-button>
                <x-button :href="$phoneHref" variant="ghost" size="lg"
                          class="w-full border border-white/30 text-on-inverse hover:bg-white/10 sm:w-auto">
                    Call the shop
                </x-button>
                <a href="#pricing"
                   class="text-center text-sm font-medium text-inverse-muted underline-offset-4 transition-colors
                          hover:text-on-inverse hover:underline sm:text-left lg:text-right">
                    Or compare memberships first
                </a>
            </div>
        </div>
    </div>
</section>
