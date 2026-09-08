// ==========================================
// MAIN SITE CONFIGURATION
// Shared site data and lightweight UI behaviors.
// ==========================================

const portfolioData = {
  name: "Pranshu Yadav",
  title: "Full-Stack Web Developer | WordPress Specialist | Web Developer",
  email: "pranshu.rama@gmail.com",
  location: "Kanpur, Uttar Pradesh, India",
  linkedin: "https://linkedin.com/in/pranshu0",
};

document.addEventListener("DOMContentLoaded", () => {
  const currentYear = document.getElementById("currentYear");
  if (currentYear) {
    currentYear.textContent = new Date().getFullYear();
  }

  const nav = document.querySelector(".navbar");
  const scrollThreshold = 20;

  const updateHeaderState = () => {
    if (nav) {
      nav.classList.toggle("scrolled", window.scrollY > scrollThreshold);
    }
  };

  updateHeaderState();
  window.addEventListener("scroll", updateHeaderState, { passive: true });

  document.querySelectorAll(".nav-link").forEach((link) => {
    link.addEventListener("click", () => {
      document.querySelectorAll(".nav-link").forEach((item) => {
        item.classList.remove("active");
      });
      link.classList.add("active");

      const collapseElement = document.querySelector(".navbar-collapse.show");
      if (collapseElement && window.bootstrap?.Collapse) {
        window.bootstrap.Collapse.getOrCreateInstance(collapseElement).hide();
      }
    });
  });

  const cursor = document.querySelector(".cursor");
  if (window.matchMedia("(pointer: fine)").matches) {
    if (cursor) {
      cursor.style.display = "block";
    }

    document.addEventListener("pointermove", (event) => {
      if (cursor) {
        cursor.style.left = `${event.clientX}px`;
        cursor.style.top = `${event.clientY}px`;
      }
    });

    document
      .querySelectorAll("a, button, .project-card, .service-card")
      .forEach((element) => {
        element.addEventListener("mouseenter", () =>
          cursor?.classList.add("active"),
        );
        element.addEventListener("mouseleave", () =>
          cursor?.classList.remove("active"),
        );
      });
  }

  window.setTimeout(() => window.portfolioHideLoader?.(), 1300);
});
