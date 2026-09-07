// ==========================================
// CONTACT FORM VALIDATION
// Submits the portfolio contact form with AJAX and messaging.
// ==========================================

document.addEventListener("DOMContentLoaded", () => {
  const form = document.getElementById("contactForm");
  if (!form) return;

  form.addEventListener("submit", async (event) => {
    event.preventDefault();

    const submitButton = form.querySelector('button[type="submit"]');
    const formMessage = document.getElementById("formMessage");
    const fields = new FormData(form);
    const data = {
      name: String(fields.get("name") || "").trim(),
      email: String(fields.get("email") || "").trim(),
      subject: String(fields.get("subject") || "").trim(),
      message: String(fields.get("message") || "").trim(),
    };

    const setMessage = (type, message) => {
      if (!formMessage) return;
      formMessage.className = `col-12 form-message ${type}`;
      formMessage.textContent = message;
    };

    setMessage("", "");

    if (!data.name || !data.email || !data.subject || !data.message) {
      setMessage("error", "Please complete all fields before submitting.");
      return;
    }

    if (submitButton) {
      submitButton.disabled = true;
      submitButton.textContent = "Sending...";
    }

    try {
      const response = await fetch(form.action, {
        method: "POST",
        headers: { Accept: "application/json" },
        body: new URLSearchParams(data),
        credentials: "same-origin",
      });
      const result = await response.json();

      if (response.ok && result.success) {
        setMessage("success", result.message);
        form.reset();
      } else {
        setMessage("error", result.message || "Something went wrong.");
      }
    } catch (error) {
      console.error("Contact form submission failed:", error);
      setMessage("error", "Unable to send message at the moment. Please try again later.");
    } finally {
      if (submitButton) {
        submitButton.disabled = false;
        submitButton.textContent = "Send Message";
      }
    }
  });
});
