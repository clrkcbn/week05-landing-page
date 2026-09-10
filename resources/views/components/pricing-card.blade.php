@props([
    'name',
    'priceMonthly',        // integer pesos / month
    'blurb',
    'features' => [],
    'featured' => false,
    'cta' => 'Choose plan',
])

<div {{ $attributes->merge([
        'class' => 'reveal relative flex h-full flex-col rounded-2xl border p-8 '
            . ($featured
                ? 'border-accent bg-surface shadow-[0_30px_70px_-40px_rgba(194,65,12,0.55)] lg:-mt-4 lg:mb-4'
                : 'border-line bg-surface'),
    ]) }}>
    @if ($featured)
        <span class="absolute -top-3 left-8 rounded-full bg-accent px-3 py-1 text-xs font-semibold
                     uppercase tracking-wider text-on-accent">
            Most booked
        </span>
    @endif

    <h3 class="font-display text-3xl uppercase tracking-wide text-ink">{{ $name }}</h3>
    <p class="mt-2 text-[15px] leading-relaxed text-muted">{{ $blurb }}</p>

    <p class="mt-6 flex items-baseline gap-1" data-price-monthly="{{ $priceMonthly }}">
        <span class="font-display text-5xl text-ink" data-price-amount>₱{{ number_format($priceMonthly) }}</span>
        <span class="text-sm font-medium text-muted" data-price-period>/month</span>
    </p>

    <x-button :href="'#contact'" :variant="$featured ? 'primary' : 'outline'" size="md"
              class="mt-6 w-full">{{ $cta }}</x-button>

    <ul class="mt-7 space-y-3 border-t border-line pt-7 text-[15px]">
        @foreach ($features as $feature)
            <li class="flex gap-3">
                <x-icon name="check" class="mt-0.5 h-4 w-4 shrink-0 text-accent" />
                <span class="text-ink/80">{{ $feature }}</span>
            </li>
        @endforeach
    </ul>
</div>
