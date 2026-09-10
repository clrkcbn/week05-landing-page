@php
    $inputClass = 'w-full rounded-xl border border-line bg-surface px-4 py-3 text-[15px] text-ink '
        . 'placeholder:text-muted/70 transition-colors focus:border-accent focus:outline-none '
        . 'focus:ring-2 focus:ring-accent/30 aria-[invalid=true]:border-accent';
    $labelClass = 'mb-1.5 block text-sm font-semibold text-ink';
    $errorClass = 'mt-1 block text-sm text-accent-strong';
@endphp

<section id="contact" class="border-t border-line py-20 lg:py-28">
    <div class="mx-auto max-w-7xl px-6 lg:px-8">
        <div class="grid gap-12 lg:grid-cols-2 lg:gap-16">
            {{-- Copy + info --}}
            <div class="reveal">
                <x-section-heading
                    eyebrow="Book your visit"
                    title="Grab a chair"
                    intro="Send this and we will text back a confirmed time within the hour during shop hours. No account needed." />

                <dl class="mt-10 space-y-5">
                    <div class="flex gap-4">
                        <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-accent-soft text-accent">
                            <x-icon name="map-pin" class="h-5 w-5" />
                        </span>
                        <div>
                            <dt class="font-semibold text-ink">Where</dt>
                            <dd class="text-[15px] text-muted">112 Katipunan Ave, Blue Ridge A, Quezon City</dd>
                        </div>
                    </div>
                    <div class="flex gap-4">
                        <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-accent-soft text-accent">
                            <x-icon name="clock" class="h-5 w-5" />
                        </span>
                        <div>
                            <dt class="font-semibold text-ink">When</dt>
                            <dd class="text-[15px] text-muted">Tuesday to Sunday, 10am to 8pm. Walk-ins before noon.</dd>
                        </div>
                    </div>
                    <div class="flex gap-4">
                        <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-accent-soft text-accent">
                            <x-icon name="phone" class="h-5 w-5" />
                        </span>
                        <div>
                            <dt class="font-semibold text-ink">Or just call</dt>
                            <dd class="text-[15px] text-muted">
                                <a href="tel:+639174428813" class="text-accent hover:underline">+63 917 442 8813</a>
                            </dd>
                        </div>
                    </div>
                </dl>
            </div>

            {{-- Form --}}
            <form data-contact-form novalidate
                  class="reveal rounded-2xl border border-line bg-surface p-6 sm:p-8" style="--reveal-delay: 100ms">
                <div class="grid gap-5 sm:grid-cols-2">
                    <div data-field class="sm:col-span-2">
                        <label for="c-name" class="{{ $labelClass }}">Name <span class="text-accent">*</span></label>
                        <input id="c-name" name="name" type="text" required autocomplete="name"
                               class="{{ $inputClass }}" placeholder="Miguel Andrada" />
                        <span data-error class="{{ $errorClass }}" aria-live="polite"></span>
                    </div>

                    <div data-field>
                        <label for="c-email" class="{{ $labelClass }}">Email <span class="text-accent">*</span></label>
                        <input id="c-email" name="email" type="email" required autocomplete="email"
                               class="{{ $inputClass }}" placeholder="you@email.com" />
                        <span data-error class="{{ $errorClass }}" aria-live="polite"></span>
                    </div>

                    <div data-field>
                        <label for="c-phone" class="{{ $labelClass }}">Mobile</label>
                        <input id="c-phone" name="phone" type="tel" autocomplete="tel" inputmode="tel"
                               class="{{ $inputClass }}" placeholder="0917 000 0000" />
                        <span data-error class="{{ $errorClass }}" aria-live="polite"></span>
                    </div>

                    <div data-field class="sm:col-span-2">
                        <label for="c-service" class="{{ $labelClass }}">What are you after?</label>
                        <select id="c-service" name="service" class="{{ $inputClass }}">
                            <option>Haircut</option>
                            <option>Haircut + beard trim</option>
                            <option>Straight-razor shave</option>
                            <option>Membership consult</option>
                            <option>Not sure yet</option>
                        </select>
                        <span data-error class="{{ $errorClass }}"></span>
                    </div>

                    <div data-field class="sm:col-span-2">
                        <label for="c-message" class="{{ $labelClass }}">Anything your barber should know?</label>
                        <textarea id="c-message" name="message" rows="3" class="{{ $inputClass }}"
                                  placeholder="Growing out a buzz, want to keep some length on top."></textarea>
                        <span data-error class="{{ $errorClass }}"></span>
                    </div>
                </div>

                <x-button type="submit" variant="primary" size="lg" class="mt-6 w-full">Send booking request</x-button>

                <p data-form-status role="status" aria-live="polite"
                   class="mt-3 min-h-5 text-center text-sm text-muted
                          data-[state=error]:text-accent-strong data-[state=success]:text-ink"></p>
            </form>
        </div>
    </div>
</section>
