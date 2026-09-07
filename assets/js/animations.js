// ==========================================
// GSAP / SCROLLTRIGGER ANIMATIONS
// Adds progressive reveal and scroll-based motion.
// ==========================================

(function () {
  const showAllReveals = () => {
    document.querySelectorAll(".reveal").forEach((item) => {
      item.classList.add("visible");
    });
  };

  try {
    const canAnimate = typeof gsap !== "undefined" && typeof ScrollTrigger !== "undefined";
    document.documentElement.classList.add("motion-ready");

    const revealItem = (item, index) => {
      if (item.dataset.revealInitialized === "true") return;
      item.dataset.revealInitialized = "true";

      if (!canAnimate) {
        item.classList.add("visible");
        return;
      }

      gsap.fromTo(
        item,
        { opacity: 0, y: 30 },
        {
          opacity: 1,
          y: 0,
          duration: 0.8,
          ease: "power2.out",
          delay: Math.min(index * 0.08, 0.4),
          scrollTrigger: {
            trigger: item,
            start: "top 88%",
            once: true,
          },
        },
      );
    };

    const refreshReveals = () => {
      if (canAnimate) {
        gsap.registerPlugin(ScrollTrigger);
      }

      document.querySelectorAll(".reveal").forEach(revealItem);
    };

    window.portfolioRefreshReveals = refreshReveals;
    refreshReveals();

    if (canAnimate && document.querySelector(".hero-card")) {
      gsap.to(".hero-card", {
        y: -14,
        duration: 4,
        ease: "sine.inOut",
        repeat: -1,
        yoyo: true,
      });
    }
  } catch (error) {
    console.error("Portfolio animations could not be initialized:", error);
    showAllReveals();
  }
})();
