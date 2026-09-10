@props([
    'variant' => 'primary',   // primary | outline | ghost | light
    'size' => 'md',           // sm | md | lg
    'href' => null,
    'type' => 'button',
    'icon' => null,           // trailing icon name (see x-icon)
])

@php
    $base = 'group inline-flex items-center justify-center gap-2 rounded-full font-semibold '
        . 'tracking-wide transition duration-200 ease-out select-none '
        . 'focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-accent '
        . 'active:translate-y-px disabled:opacity-50 disabled:pointer-events-none '
        . 'data-[loading=true]:opacity-70 data-[loading=true]:pointer-events-none';

    $sizes = [
        'sm' => 'px-4 py-2 text-sm',
        'md' => 'px-6 py-3 text-[15px]',
        'lg' => 'px-8 py-4 text-base',
    ];

    $variants = [
        // Rust fill -- the one primary action colour, ~5.9:1 on its label.
        'primary' => 'bg-accent text-on-accent hover:bg-accent-strong shadow-sm shadow-accent/25',
        // Ink outline for secondary actions on light surfaces.
        'outline' => 'border border-ink/25 text-ink hover:border-ink hover:bg-ink/[0.04]',
        // Quiet text action.
        'ghost' => 'text-ink hover:bg-ink/[0.06]',
        // For use on the dark inverse band.
        'light' => 'bg-on-inverse text-inverse hover:bg-white',
    ];

    $classes = trim("$base {$sizes[$size]} {$variants[$variant]}");
@endphp

@if ($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        <span>{{ $slot }}</span>
        @if ($icon)
            <x-icon :name="$icon"
                    class="h-4 w-4 transition-transform duration-200 group-hover:translate-x-0.5" />
        @endif
    </a>
@else
    <button type="{{ $type }}" {{ $attributes->merge(['class' => $classes]) }}>
        <span>{{ $slot }}</span>
        @if ($icon)
            <x-icon :name="$icon"
                    class="h-4 w-4 transition-transform duration-200 group-hover:translate-x-0.5" />
        @endif
    </button>
@endif
