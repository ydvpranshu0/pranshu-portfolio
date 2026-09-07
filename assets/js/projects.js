// ==========================================
// FEATURED PROJECTS DATA
// Centralized project list for easy updates.
// ==========================================

const projectData = [
  {
    name: "KFL",
    category: "Business & Corporate",
    url: "https://kfl.net.in/",
    description:
      "Business website focused on presenting the company profile and service offerings with a clean digital presence.",
    tech: "WordPress, HTML, CSS, JavaScript",
    preview: "KFL",
  },
  {
    name: "Taxioor",
    category: "Business Services",
    url: "https://taxioor.com/",
    description:
      "Website project for a service-focused brand requiring a professional look and conversion-oriented layout.",
    tech: "WordPress, Responsive Design, SEO",
    preview: "Taxioor",
  },
  {
    name: "Daily Nutrition",
    category: "Healthcare & Wellness",
    url: "https://dailynutrition.in/",
    description:
      "Website for a wellness-focused business built around clarity, trust and responsive mobile experience.",
    tech: "WordPress, Bootstrap, UI Structure",
    preview: "Daily Nutrition",
  },
  {
    name: "Holiday Lighting Company",
    category: "Home Services",
    url: "http://holidaylightingcompanyct.com/",
    description:
      "Service website designed for home and holiday lighting offerings with user-friendly navigation and clear calls to action.",
    tech: "WordPress, Content Layout, Responsive Design",
    preview: "Holiday Lighting Company",
  },
];

function renderProjects() {
  const projectContainer = document.getElementById("featured-projects");
  if (!projectContainer) return;

  projectContainer.innerHTML = projectData
    .map(
      (project) => `
    <article class="project-card reveal">
      <div class="project-media" aria-label="${project.name} preview">
        <svg viewBox="0 0 200 120" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
          <rect x="18" y="24" width="164" height="72" rx="12" fill="rgba(255,255,255,0.08)" stroke="rgba(255,255,255,0.22)"/>
          <rect x="32" y="38" width="62" height="12" rx="6" fill="rgba(255,106,0,0.7)"/>
          <rect x="32" y="58" width="114" height="8" rx="4" fill="rgba(255,255,255,0.28)"/>
          <rect x="32" y="72" width="88" height="8" rx="4" fill="rgba(255,255,255,0.18)"/>
          <circle cx="146" cy="60" r="18" fill="rgba(255,106,0,0.47)"/>
        </svg>
      </div>
      <div class="project-card-content">
        <div class="project-meta">
          <span>${project.category}</span>
          <span>${project.preview}</span>
        </div>
        <h3>${project.name}</h3>
        <p>${project.description}</p>
        <small>${project.tech}</small>
        <div class="project-actions">
          <a href="${project.url}" class="project-link" target="_blank" rel="noopener">Visit Website</a>
        </div>
      </div>
    </article>
  `,
    )
    .join("");

  window.portfolioRefreshReveals?.();
}

if (document.readyState === "loading") {
  document.addEventListener("DOMContentLoaded", renderProjects, { once: true });
} else {
  renderProjects();
}
