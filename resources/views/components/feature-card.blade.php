@props([
    'icon' => 'sparkle',
    'title',
    'description',
    'tone' => 'default',   // default | accent
])

@php
    $card = $tone === 'accent'
        ? 'bg-accent-soft border-accent/20'
        : 'bg-surface border-line';
    $chip = $tone === 'accent'
        ? 'bg-accent text-on-accent'
        : 'bg-ink/[0.06] text-ink';
@endphp

<div {{ $attributes->merge([
        'class' => "reveal group flex h-full flex-col rounded-2xl border p-7 transition
                    duration-300 hover:-translate-y-1 hover:shadow-[0_18px_40px_-24px_rgba(27,26,24,0.35)] $card",
    ]) }}>
    <span class="flex h-12 w-12 items-center justify-center rounded-full {{ $chip }}">
        <x-icon :name="$icon" class="h-6 w-6" />
    </span>
    <h3 class="mt-5 font-display text-2xl uppercase tracking-wide text-ink">{{ $title }}</h3>
    <p class="mt-2 text-[15px] leading-relaxed text-muted">{{ $description }}</p>
</div>
