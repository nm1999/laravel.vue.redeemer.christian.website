import { onBeforeUnmount, onMounted } from 'vue';

export function useScrollReveal(selector = '.scroll-reveal') {
  let observer = null;

  const revealAllImmediately = (elements) => {
    elements.forEach((element) => element.classList.add('is-visible'));
  };

  const setup = () => {
    const revealElements = document.querySelectorAll(selector);

    if (!revealElements.length) {
      return;
    }

    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
      revealAllImmediately(revealElements);
      return;
    }

    observer = new IntersectionObserver(
      (entries) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) {
            entry.target.classList.add('is-visible');
            observer?.unobserve(entry.target);
          }
        });
      },
      {
        threshold: 0.16,
        rootMargin: '0px 0px -8% 0px',
      },
    );

    revealElements.forEach((element) => {
      observer?.observe(element);
    });
  };

  const cleanup = () => {
    observer?.disconnect();
    observer = null;
  };

  onMounted(setup);
  onBeforeUnmount(cleanup);
}
