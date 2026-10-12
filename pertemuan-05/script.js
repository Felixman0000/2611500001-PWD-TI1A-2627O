const navToggle = document.querySelector(".menu-toggle");
const navMenu = document.querySelector("header nav");

if (navToggle && navMenu) {
  navToggle.addEventListener("click", () => {
    const isOpen = navMenu.classList.toggle("active");
    navToggle.setAttribute("aria-expanded", String(isOpen));
    navToggle.setAttribute(
      "aria-label",
      isOpen ? "Tutup navigasi" : "Buka navigasi",
    );
  });

  navMenu.querySelectorAll("a").forEach((link) => {
    link.addEventListener("click", () => {
      navMenu.classList.remove("active");
      navToggle.setAttribute("aria-expanded", "false");
      navToggle.setAttribute("aria-label", "Buka navigasi");
    });
  });
}

const contactForm = document.getElementById("contactForm");
const feedback = document.getElementById("form-feedback");
const nameInput = contactForm?.elements.namedItem("name");
const phoneInput = contactForm?.elements.namedItem("phone");
const dateInput = contactForm?.elements.namedItem("tanggal_lahir");

if (dateInput) {
  const today = new Date();
  const year = today.getFullYear();
  const month = String(today.getMonth() + 1).padStart(2, "0");
  const day = String(today.getDate()).padStart(2, "0");
  dateInput.max = `${year}-${month}-${day}`;
}

if (contactForm && feedback && nameInput && phoneInput) {
  const showFeedback = (message, isSuccess = false) => {
    feedback.textContent = message;
    feedback.className = isSuccess
      ? "form-feedback form-feedback-success"
      : "form-feedback form-feedback-error";
    feedback.hidden = false;
  };

  contactForm.addEventListener("submit", (event) => {
    event.preventDefault();
    nameInput.setCustomValidity("");
    phoneInput.setCustomValidity("");

    const nameLength = nameInput.value.trim().length;
    const phone = phoneInput.value.trim();
    const digitCount = phone.replace(/\D/g, "").length;
    const phoneCharactersAreValid = /^[0-9+().\s-]+$/.test(phone);

    if (nameLength < 3 || nameLength > 50) {
      nameInput.setCustomValidity(
        "Nama harus berisi 3 sampai 50 karakter selain spasi di awal atau akhir.",
      );
    }

    if (
      phone &&
      (!phoneCharactersAreValid || digitCount < 8 || digitCount > 15)
    ) {
      phoneInput.setCustomValidity(
        "Nomor telepon harus berisi 8 sampai 15 angka; spasi, +, tanda kurung, dan tanda hubung diperbolehkan.",
      );
    }

    if (!contactForm.checkValidity()) {
      showFeedback("Data belum valid. Periksa kembali isian yang ditandai.");
      contactForm.querySelector(":invalid")?.focus();
      contactForm.reportValidity();
      return;
    }

    showFeedback(
      "Form berhasil divalidasi di sisi klien. Data belum dikirim atau disimpan.",
      true,
    );
  });

  contactForm.addEventListener("input", () => {
    nameInput.setCustomValidity("");
    phoneInput.setCustomValidity("");
    feedback.hidden = true;
    feedback.textContent = "";
  });

  contactForm.addEventListener("reset", () => {
    nameInput.setCustomValidity("");
    phoneInput.setCustomValidity("");
    feedback.hidden = true;
    feedback.textContent = "";
  });
}
