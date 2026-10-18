const header = document.querySelector('.site-header');
document.querySelectorAll('[data-brand-carousel]').forEach(carousel => {
    const track = carousel.querySelector('.brand-carousel-track');
    const previous = carousel.querySelector('[data-brand-previous]');
    const next = carousel.querySelector('[data-brand-next]');
    const updateControls = () => {
        previous.disabled = track.scrollLeft <= 1;
        next.disabled = track.scrollLeft + track.clientWidth >= track.scrollWidth - 1;
    };
    const move = direction => {
        track.scrollBy({
            left: direction * (track.clientWidth + parseFloat(getComputedStyle(track).gap)),
            behavior: window.matchMedia('(prefers-reduced-motion: reduce)').matches ? 'instant' : 'smooth',
        });
    };
    previous.addEventListener('click', () => move(-1));
    next.addEventListener('click', () => move(1));
    track.addEventListener('scroll', updateControls, { passive: true });
    window.addEventListener('resize', updateControls);
    window.addEventListener('pageshow', updateControls);
    updateControls();
});

if (header) {
    let scheduled = false;
    const update = () => {
        if (window.scrollY > 64) header.classList.add('is-scrolled');
        else if (window.scrollY < 16) header.classList.remove('is-scrolled');
        scheduled = false;
    };
    window.addEventListener('scroll', () => {
        if (!scheduled) {
            scheduled = true;
            requestAnimationFrame(update);
        }
    }, { passive: true });
    window.addEventListener('pageshow', update);
    update();
}

if ('IntersectionObserver' in window && !window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
    const observer = new IntersectionObserver(entries => {
        for (const entry of entries) {
            if (entry.isIntersecting) {
                entry.target.classList.add('show');
                observer.unobserve(entry.target);
            }
        }
    });
    document.querySelectorAll('.ZoomOutAnimation').forEach(element => observer.observe(element));
}
