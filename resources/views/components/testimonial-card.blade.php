@props([
    'quote',
    'name',
    'position',
    'photo',
    'rating' => 5,
])

<figure {{ $attributes->merge([
        'class' => 'reveal flex h-full flex-col rounded-2xl border border-line bg-surface p-7',
    ]) }}>
    <div class="flex items-center gap-1 text-accent" aria-hidden="true">
        @for ($i = 0; $i < $rating; $i++)
            <x-icon name="star" class="h-4 w-4" />
        @endfor
    </div>
    <span class="sr-only">Rated {{ $rating }} out of 5.</span>

    <blockquote class="mt-4 flex-1 text-[17px] leading-relaxed text-ink/90">
        &ldquo;{{ $quote }}&rdquo;
    </blockquote>

    <figcaption class="mt-6 flex items-center gap-3 border-t border-line pt-5">
        <img src="{{ $photo }}" width="96" height="96" loading="lazy" decoding="async"
             alt="Portrait of {{ $name }}"
             class="h-11 w-11 rounded-full object-cover" />
        <span>
            <span class="block font-semibold text-ink">{{ $name }}</span>
            <span class="block text-sm text-muted">{{ $position }}</span>
        </span>
    </figcaption>
</figure>
