/**
 * Header Scroll State
 * Adds 'scrolled' class to body when user scrolls down
 */
(function() {
  let lastScrollTop = 0;
  const scrollThreshold = 100; // Pixels to scroll before triggering

  function handleScroll() {
    const scrollTop = window.pageYOffset || document.documentElement.scrollTop;

    if (scrollTop > scrollThreshold) {
      document.body.classList.add('scrolled');
    } else {
      document.body.classList.remove('scrolled');
    }

    lastScrollTop = scrollTop;
  }

  // Throttle scroll events for better performance
  let ticking = false;
  window.addEventListener('scroll', function() {
    if (!ticking) {
      window.requestAnimationFrame(function() {
        handleScroll();
        ticking = false;
      });
      ticking = true;
    }
  });

  // Check scroll position on load
  handleScroll();
})();
