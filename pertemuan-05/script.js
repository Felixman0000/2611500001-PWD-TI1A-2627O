const navToggle = document.querySelector(".menu-toggle");
const navMenu = document.querySelector("header nav");

if (navToggle && navMenu) {
  navToggle.setAttribute("aria-expanded", "false");
  navToggle.setAttribute("aria-label", "Buka navigasi");

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

const contactForm = document.querySelector("#contact form");
const phoneInput = contactForm?.elements.namedItem("phone");

if (phoneInput) {
  const validatePhone = () => {
    const digitCount = phoneInput.value.replace(/\D/g, "").length;
    const isValid = digitCount >= 8 && digitCount <= 15;

    phoneInput.setCustomValidity(
      isValid || phoneInput.value === ""
        ? ""
        : "Nomor telepon harus berisi 8 sampai 15 angka.",
    );
  };

  validatePhone();
  phoneInput.addEventListener("input", validatePhone);
}
