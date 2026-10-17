const header = document.querySelector('.site-header');
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
