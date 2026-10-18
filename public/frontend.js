const header = document.querySelector('.site-header');
document.querySelectorAll('[data-brand-carousel]').forEach(carousel => {
    const track = carousel.querySelector('.brand-carousel-track');
    const previous = carousel.querySelector('[data-brand-previous]');
    const next = carousel.querySelector('[data-brand-next]');
    const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)');
    const originals = [...track.children];
    originals.forEach(item => {
        const clone = item.cloneNode(true);
        clone.setAttribute('aria-hidden', 'true');
        clone.inert = true;
        track.append(clone);
    });
    const loopWidth = () => track.children[originals.length].offsetLeft - track.children[0].offsetLeft;
    let position = track.scrollLeft;
    let lastTime = 0;
    let interacting = false;
    let resumeAt = 0;
    previous.disabled = false;
    next.disabled = false;

    const move = direction => {
        const width = loopWidth();
        if (!width) return;
        position = (track.scrollLeft + direction * (originals[0].getBoundingClientRect().width + parseFloat(getComputedStyle(track).gap)) + width) % width;
        track.scrollLeft = position;
        resumeAt = performance.now() + 2500;
    };
    previous.addEventListener('click', () => move(-1));
    next.addEventListener('click', () => move(1));
    track.addEventListener('pointerdown', () => { interacting = true; });
    window.addEventListener('pointerup', () => { interacting = false; });
    window.addEventListener('pointercancel', () => { interacting = false; });
    track.addEventListener('scroll', () => {
        if (interacting || carousel.matches(':hover') || carousel.contains(document.activeElement)) {
            position = track.scrollLeft;
        }
    }, { passive: true });

    const animate = time => {
        const elapsed = lastTime ? Math.min(time - lastTime, 50) : 0;
        lastTime = time;
        if (!reducedMotion.matches && !document.hidden && !interacting &&
            !carousel.matches(':hover') && !carousel.contains(document.activeElement) && time >= resumeAt) {
            const width = loopWidth();
            if (width > 0) {
                position = (position + elapsed * 0.03) % width;
                track.scrollLeft = position;
            }
        }
        requestAnimationFrame(animate);
    };
    requestAnimationFrame(animate);
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
