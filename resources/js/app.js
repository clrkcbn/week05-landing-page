/**
 * Fadehouse Barber Co. -- landing page behaviour.
 * Vanilla JS only. Every enhancement degrades to a usable static page.
 */

/* ------------------------------------------------------------------ */
/*  Theme toggle (light / dark), persisted per visitor.               */
/*  The pre-paint boot script lives inline in layouts/app.blade.php   */
/*  so there is no flash of the wrong theme.                          */
/* ------------------------------------------------------------------ */
function initThemeToggle() {
    const root = document.documentElement;
    const buttons = document.querySelectorAll('[data-theme-toggle]');
    if (!buttons.length) return;

    const systemDark = window.matchMedia('(prefers-color-scheme: dark)');
    const current = () =>
        root.dataset.theme || (systemDark.matches ? 'dark' : 'light');

    const sync = () => {
        const isDark = current() === 'dark';
        buttons.forEach((btn) => {
            btn.setAttribute('aria-pressed', String(isDark));
            btn.setAttribute(
                'aria-label',
                isDark ? 'Switch to light theme' : 'Switch to dark theme',
            );
        });
    };

    buttons.forEach((btn) => {
        btn.addEventListener('click', () => {
            const next = current() === 'dark' ? 'light' : 'dark';
            root.dataset.theme = next;
            try {
                localStorage.setItem('fh-theme', next);
            } catch (e) {
                /* storage blocked -- fine, choice lasts the session */
            }
            sync();
        });
    });

    sync();
}

/* ------------------------------------------------------------------ */
/*  Mobile navigation drawer.                                         */
/* ------------------------------------------------------------------ */
function initMobileNav() {
    const toggle = document.querySelector('[data-nav-toggle]');
    const panel = document.querySelector('[data-nav-panel]');
    if (!toggle || !panel) return;

    const setOpen = (open) => {
        panel.hidden = !open;
        toggle.setAttribute('aria-expanded', String(open));
        document.body.style.overflow = open ? 'hidden' : '';
    };

    toggle.addEventListener('click', () => {
        setOpen(panel.hidden);
    });

    panel.querySelectorAll('a').forEach((link) => {
        link.addEventListener('click', () => setOpen(false));
    });

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && !panel.hidden) {
            setOpen(false);
            toggle.focus();
        }
    });

    // Reset when resizing up to desktop.
    window.matchMedia('(min-width: 1024px)').addEventListener('change', (e) => {
        if (e.matches) setOpen(false);
    });
}

/* ------------------------------------------------------------------ */
/*  Scroll reveal.                                                    */
/* ------------------------------------------------------------------ */
function initScrollReveal() {
    const items = document.querySelectorAll('.reveal');
    if (!items.length) return;

    const reduce = window.matchMedia('(prefers-reduced-motion: reduce)');
    if (reduce.matches || !('IntersectionObserver' in window)) {
        items.forEach((el) => el.classList.add('is-visible'));
        return;
    }

    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    observer.unobserve(entry.target);
                }
            });
        },
        { rootMargin: '0px 0px -10% 0px', threshold: 0.12 },
    );

    items.forEach((el) => observer.observe(el));
}

/* ------------------------------------------------------------------ */
/*  Pricing billing switch (monthly / annual).                        */
/*  Annual = pay for 10 months, get 12.                               */
/* ------------------------------------------------------------------ */
function initBillingSwitch() {
    const input = document.querySelector('[data-billing-switch]');
    const prices = document.querySelectorAll('[data-price-monthly]');
    if (!input || !prices.length) return;

    const peso = new Intl.NumberFormat('en-PH');

    const render = () => {
        const annual = input.checked;
        prices.forEach((el) => {
            const monthly = Number(el.dataset.priceMonthly);
            const shown = annual ? Math.round((monthly * 10) / 12) : monthly;
            const amount = el.querySelector('[data-price-amount]');
            const period = el.querySelector('[data-price-period]');
            if (amount) amount.textContent = '₱' + peso.format(shown);
            if (period) {
                period.textContent = annual ? '/mo, billed yearly' : '/month';
            }
        });
        document
            .querySelectorAll('[data-billing-label]')
            .forEach((label) => {
                label.classList.toggle(
                    'text-ink',
                    label.dataset.billingLabel === (annual ? 'annual' : 'monthly'),
                );
                label.classList.toggle(
                    'text-muted',
                    label.dataset.billingLabel !== (annual ? 'annual' : 'monthly'),
                );
            });
    };

    input.addEventListener('change', render);
    render();
}

/* ------------------------------------------------------------------ */
/*  Contact form -- inline validation + fake async submit.            */
/* ------------------------------------------------------------------ */
function initContactForm() {
    const form = document.querySelector('[data-contact-form]');
    if (!form) return;

    const status = form.querySelector('[data-form-status]');
    const submit = form.querySelector('button[type="submit"]');

    const showError = (field, message) => {
        const wrap = field.closest('[data-field]');
        const error = wrap?.querySelector('[data-error]');
        field.setAttribute('aria-invalid', 'true');
        if (error) error.textContent = message;
    };

    const clearError = (field) => {
        const wrap = field.closest('[data-field]');
        const error = wrap?.querySelector('[data-error]');
        field.removeAttribute('aria-invalid');
        if (error) error.textContent = '';
    };

    form.querySelectorAll('input, textarea').forEach((field) => {
        field.addEventListener('blur', () => {
            if (field.required && !field.value.trim()) {
                showError(field, 'This field is required.');
            } else if (field.type === 'email' && field.value && !field.checkValidity()) {
                showError(field, 'Enter a valid email address.');
            } else {
                clearError(field);
            }
        });
    });

    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        let firstInvalid = null;

        form.querySelectorAll('input, textarea').forEach((field) => {
            const empty = field.required && !field.value.trim();
            const badEmail =
                field.type === 'email' && field.value && !field.checkValidity();
            if (empty || badEmail) {
                showError(
                    field,
                    empty ? 'This field is required.' : 'Enter a valid email address.',
                );
                if (!firstInvalid) firstInvalid = field;
            } else {
                clearError(field);
            }
        });

        if (firstInvalid) {
            firstInvalid.focus();
            if (status) {
                status.textContent = 'Please fix the highlighted fields.';
                status.dataset.state = 'error';
            }
            return;
        }

        submit.disabled = true;
        submit.dataset.loading = 'true';
        if (status) {
            status.textContent = 'Sending…';
            status.dataset.state = 'pending';
        }

        await new Promise((r) => setTimeout(r, 900));

        submit.disabled = false;
        delete submit.dataset.loading;
        form.reset();
        if (status) {
            status.textContent =
                "Thanks. We'll text you back within the hour during shop hours.";
            status.dataset.state = 'success';
        }
    });
}

/* ------------------------------------------------------------------ */
/*  Sticky nav shadow once the page has scrolled.                     */
/* ------------------------------------------------------------------ */
function initNavShadow() {
    const nav = document.querySelector('[data-nav]');
    if (!nav) return;
    const io = new IntersectionObserver(
        ([entry]) => nav.toggleAttribute('data-scrolled', !entry.isIntersecting),
        { threshold: 1 },
    );
    const sentinel = document.querySelector('[data-nav-sentinel]');
    if (sentinel) io.observe(sentinel);
}

document.addEventListener('DOMContentLoaded', () => {
    initThemeToggle();
    initMobileNav();
    initScrollReveal();
    initBillingSwitch();
    initContactForm();
    initNavShadow();
});
