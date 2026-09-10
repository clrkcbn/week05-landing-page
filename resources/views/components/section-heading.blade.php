@props([
    'eyebrow' => null,
    'title',
    'intro' => null,
    'align' => 'left',   // left | center
    'tone' => 'default',  // default | inverse
])

@php
    $wrap = $align === 'center' ? 'mx-auto max-w-2xl text-center' : 'max-w-2xl';
    $titleColor = $tone === 'inverse' ? 'text-on-inverse' : 'text-ink';
    $introColor = $tone === 'inverse' ? 'text-inverse-muted' : 'text-muted';
    $ruleColor = $tone === 'inverse' ? 'bg-on-accent/70' : 'bg-accent';
@endphp

<div {{ $attributes->merge(['class' => $wrap]) }}>
    @if ($eyebrow)
        <div class="mb-4 flex items-center gap-3 {{ $align === 'center' ? 'justify-center' : '' }}">
            <span class="h-px w-8 {{ $ruleColor }}"></span>
            <span class="text-xs font-semibold uppercase tracking-[0.22em] text-accent">{{ $eyebrow }}</span>
        </div>
    @endif

    <h2 class="font-display text-4xl uppercase leading-[0.95] {{ $titleColor }} sm:text-5xl lg:text-6xl">
        {{ $title }}
    </h2>

    @if ($intro)
        <p class="mt-5 text-lg leading-relaxed {{ $introColor }}">
            {{ $intro }}
        </p>
    @endif
</div>
