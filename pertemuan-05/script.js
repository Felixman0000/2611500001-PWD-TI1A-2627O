const navToggle = document.getElementById("navToggle");
const navMenu = document.getElementById("navMenu");

if (navToggle && navMenu) {
  navToggle.addEventListener("click", () => {
    const isOpen = navMenu.classList.toggle("active");
    navToggle.setAttribute("aria-expanded", isOpen);
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
const formFeedback = document.getElementById("form-feedback");
const namaInput = document.getElementById("name");
const emailInput = document.getElementById("email");
const phoneInput = document.getElementById("phone");
const tanggalInput = document.getElementById("tanggal-lahir");

if (tanggalInput) {
  const today = new Date();
  const year = today.getFullYear();
  const month = String(today.getMonth() + 1).padStart(2, "0");
  const day = String(today.getDate()).padStart(2, "0");
  tanggalInput.max = `${year}-${month}-${day}`;
}

if (contactForm && formFeedback) {
  contactForm.addEventListener("submit", (event) => {
    event.preventDefault();
    formFeedback.className = "form-feedback form-feedback-error";

    const nama = namaInput.value.trim();
    if (nama.length < 3 || nama.length > 50) {
      formFeedback.textContent =
        "Nama lengkap harus diisi 3 sampai 50 karakter.";
      formFeedback.hidden = false;
      return;
    }

    const email = emailInput.value.trim();
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailPattern.test(email)) {
      formFeedback.textContent = "Masukkan alamat email yang valid.";
      formFeedback.hidden = false;
      return;
    }

    const phone = phoneInput.value.trim();
    const phoneDigits = phone.replace(/\D/g, "");
    const phonePattern = /^[0-9+().\s-]+$/;
    if (
      !phonePattern.test(phone) ||
      phoneDigits.length < 8 ||
      phoneDigits.length > 15
    ) {
      formFeedback.textContent =
        "Nomor telepon harus berisi 8 sampai 15 angka.";
      formFeedback.hidden = false;
      return;
    }

    const tanggal = tanggalInput.value;
    if (tanggal === "") {
      formFeedback.textContent = "Tanggal lahir harus diisi.";
      formFeedback.hidden = false;
      return;
    }

    if (tanggal > tanggalInput.max) {
      formFeedback.textContent = "Tanggal lahir tidak boleh melebihi hari ini.";
      formFeedback.hidden = false;
      return;
    }

    const prodiDipilih = document.querySelectorAll(
      'input[name="prodi[]"]:checked',
    );
    if (prodiDipilih.length === 0) {
      formFeedback.textContent = "Pilih minimal satu program studi.";
      formFeedback.hidden = false;
      return;
    }

    const prediksiDipilih = document.querySelector(
      'input[name="prediksi"]:checked',
    );
    if (!prediksiDipilih) {
      formFeedback.textContent = "Pilih salah satu prediksi.";
      formFeedback.hidden = false;
      return;
    }

    formFeedback.textContent = "Form berhasil divalidasi.";
    formFeedback.className = "form-feedback form-feedback-success";
    formFeedback.hidden = false;
  });

  contactForm.addEventListener("reset", () => {
    formFeedback.textContent = "";
    formFeedback.hidden = true;
  });

  contactForm.addEventListener("input", () => {
    formFeedback.textContent = "";
    formFeedback.hidden = true;
  });
}
