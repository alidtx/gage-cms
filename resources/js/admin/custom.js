        // ========== DROPDOWN TOGGLE ==========
        function toggleDropdown(trigger) {
            const panel = trigger.nextElementSibling;
            const isOpen = panel.classList.contains('open');

            // Close all other dropdowns (accordion behavior — remove this block if you want multiple open)
            document.querySelectorAll('.dropdown-panel.open').forEach(p => {
                if (p !== panel) {
                    p.classList.remove('open');
                    p.previousElementSibling.classList.remove('open');
                }
            });

            // Toggle current
            if (isOpen) {
                panel.classList.remove('open');
                trigger.classList.remove('open');
            } else {
                panel.classList.add('open');
                trigger.classList.add('open');
            }
        }

        // Auto-open dropdown if a sub-item inside matches the current hash
        function openActiveDropdown() {
            const hash = window.location.hash;
            if (!hash) return;
            const activeSub = document.querySelector(`.sub-item[href="${hash}"]`);
            if (activeSub) {
                const panel = activeSub.closest('.dropdown-panel');
                const trigger = panel?.previousElementSibling;
                if (panel && trigger) {
                    panel.classList.add('open');
                    trigger.classList.add('open');
                }
            }
        }

        // ========== SIDEBAR NAVIGATION (with sub-items) ==========
        document.querySelectorAll('.sidebar-item, .sub-item').forEach(item => {
            item.addEventListener('click', function(e) {
                const href = this.getAttribute('href');
                if (!href || !href.startsWith('#')) return;
                e.preventDefault();

                const target = href.substring(1);

                // If it's a top-level item (not a sub-item), close all dropdowns when navigating
                if (this.classList.contains('sidebar-item')) {
                    document.querySelectorAll('.dropdown-panel.open').forEach(p => {
                        p.classList.remove('open');
                        p.previousElementSibling.classList.remove('open');
                    });
                }

                // Update active state across all items
                document.querySelectorAll('.sidebar-item, .sub-item').forEach(el => el.classList.remove('active'));
                this.classList.add('active');

                // Hide all sections
                document.querySelectorAll('main > div[id]').forEach(el => {
                    el.classList.add('hidden');
                });

                // Show target
                const targetElement = document.getElementById(target);
                if (targetElement) {
                    targetElement.classList.remove('hidden');
                }

                // Update hash without page jump
                history.replaceState(null, '', href);
            });
        });

        // ========== CHARACTER COUNTERS ==========
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('input[maxlength], textarea[maxlength]').forEach(el => {
                const counter = document.createElement('span');
                counter.className = 'text-xs text-green-600 font-medium block mt-1';
                counter.textContent = `${el.value.length} / ${el.maxLength}`;
                el.parentNode.appendChild(counter);

                el.addEventListener('input', function() {
                    const length = this.value.length;
                    const max = this.maxLength;
                    counter.textContent = `${length} / ${max}`;
                    counter.className = length > max * 0.9
                        ? 'text-xs text-red-600 font-medium block mt-1'
                        : 'text-xs text-green-600 font-medium block mt-1';
                });
            });

            // Restore open dropdown if URL has a hash on load
            openActiveDropdown();
        });

        // Re-open dropdown when user reloads with a hash
        window.addEventListener('hashchange', openActiveDropdown);