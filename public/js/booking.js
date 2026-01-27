// ===================================
// BOOKING PAGE - ADVANCED FEATURES (DP SYSTEM & AVAILABILITY)
// ===================================

document.addEventListener("DOMContentLoaded", function () {
    // Get form elements
    const bookingForm = document.getElementById("bookingForm");
    const serviceOptions = document.querySelectorAll(
        'input[name="service_id"]',
    );
    const barberOptions = document.querySelectorAll('input[name="barber"]');
    const paymentOptions = document.querySelectorAll('input[name="payment"]');
    // const timeInput = document.getElementById("bookingTime");
    const timeSlotsGrid = document.getElementById("timeSlotsGrid");
    const optionCards = document.querySelectorAll(".option-card");

    // Summary elements
    const summaryService = document.getElementById("summaryService");
    const summaryBarber = document.getElementById("summaryBarber");
    const summaryDate = document.getElementById("summaryDate");
    const summaryTime = document.getElementById("summaryTime");
    const summaryDuration = document.getElementById("summaryDuration");
    const summaryPayment = document.getElementById("summaryPayment");
    const summaryTotal = document.getElementById("summaryTotal");
    const summaryDP = document.getElementById("summaryDP");

    // Payment Modal elements
    const paymentModal = document.getElementById("paymentModal");
    const closePaymentModal = document.getElementById("closePaymentModal");
    const modalPaymentMethod = document.getElementById("modalPaymentMethod");
    const modalDPAmount = document.getElementById("modalDPAmount");
    const modalAccountInfo = document.getElementById("modalAccountInfo");
    const qrisContainer = document.getElementById("qrisContainer");
    const confirmPaidBtn = document.getElementById("confirmPaidBtn");
    const successOverlay = document.getElementById("successOverlay");
    const randomIdSpan = document.getElementById("randomId");

    const dateInput = document.getElementById("bookingDate");
    const grid = document.getElementById("timeSlotsGrid");

    if (dateInput && grid) {
        dateInput.addEventListener("change", function () {
            const date = this.value;
            const url = grid.dataset.url;

            if (!date || !url) return;

            grid.innerHTML = "<p>Memuat jam tersedia...</p>";

            fetch(`${url}?date=${date}`)
                .then((res) => {
                    if (!res.ok) throw new Error("Request gagal");
                    return res.text();
                })
                .then((html) => {
                    grid.innerHTML = html;
                })
                .catch(() => {
                    grid.innerHTML =
                        '<p style="color:red">Gagal memuat jam.</p>';
                });
        });
    }

    const selectedTime = document.querySelector(
        'input[name="bookingTime"]:checked',
    );

    if (selectedTime) {
        summaryTime.textContent = selectedTime.value;
        console.log(selectedTime.value);
    } else {
        summaryTime.textContent = "-";
    }

    if (timeSlotsGrid) {
        timeSlotsGrid.addEventListener("change", function (e) {
            if (e.target.name === "bookingTime") {
                updateSummary();
            }
        });
    }

    // Helper to get date string YYYY-MM-DD for X days from now
    function getDateString(daysFromNow) {
        const d = new Date();
        d.setDate(d.getDate() + daysFromNow);
        return d.toISOString().split("T")[0];
    }

    // MOCK BOOKED SLOTS (Simulated Backend Data)
    // Format: "YYYY-MM-DD": ["HH:MM", "HH:MM"]
    const mockBookedSlots = {
        [getDateString(1)]: ["10:00", "14:00", "15:00", "19:00"], // Tomorrow
        [getDateString(2)]: ["09:00", "12:00", "13:00"], // Day after tomorrow
        [getDateString(3)]: ["16:00", "17:00", "20:00"], // 3 days from now
    };

    // ===================================
    // OPTION CARD SELECTION VISUAL FEEDBACK
    // ===================================
    optionCards.forEach((card) => {
        card.addEventListener("click", function () {
            const radio = this.querySelector('input[type="radio"]');
            const radioName = radio.getAttribute("name");

            // 1. Remove selected class from all cards with same name
            document
                .querySelectorAll(`input[name="${radioName}"]`)
                .forEach((r) => {
                    r.closest(".option-card").classList.remove("selected");
                });

            // 2. Add selected class to clicked card
            this.classList.add("selected");
            radio.checked = true;

            // 3. LOGIKA KHUSUS QRIS (Update di sini)
            if (radioName === "payment") {
                const qrisArea = document.getElementById("qris-display-area");
                if (radio.value === "qris") {
                    qrisArea.style.display = "block"; // Tampilkan
                } else {
                    qrisArea.style.display = "none"; // Sembunyikan jika pilih bank lain
                }
            }

            // 4. Update summary
            updateSummary();
        });
    });

    // ===================================
    // CHECK ON PAGE LOAD (Untuk handle Old Input Laravel)
    // ===================================
    // Fungsi ini mengecek apakah radio QRIS sedang terpilih saat halaman dimuat ulang
    document.addEventListener("DOMContentLoaded", function () {
        const qrisRadio = document.querySelector(
            'input[name="payment"][value="qris"]',
        );
        const qrisArea = document.getElementById("qris-display-area");

        if (qrisRadio && qrisRadio.checked) {
            qrisRadio.closest(".option-card").classList.add("selected");
            qrisArea.style.display = "block";
        }
    });
    // ===================================
    // SET MINIMUM DATE TO TOMORROW
    // ===================================
    const today = new Date();
    const tomorrow = new Date(today);
    tomorrow.setDate(tomorrow.getDate() + 1);

    const minDate = tomorrow.toISOString().split("T")[0];
    if (dateInput) dateInput.setAttribute("min", minDate);

    // ===================================
    // PAYMENT METHOD CHANGE HANDLER
    // ===================================
    paymentOptions.forEach((option) => {
        option.addEventListener("change", function () {
            // Show QRIS container if QRIS is selected, hide otherwise
            if (this.value === "qris") {
                qrisContainer.style.display = "block";
            } else {
                qrisContainer.style.display = "none";
            }
        });
    });

    // ===================================
    // UPDATE SUMMARY FUNCTION
    // ===================================
    function updateSummary() {
        // ========================
        // SERVICE
        // ========================
        const selectedService = document.querySelector(
            'input[name="service_id"]:checked',
        );

        if (selectedService) {
            const serviceCard = selectedService.closest(".option-card");
            const serviceName =
                serviceCard.querySelector(".option-title").textContent;

            const price = parseInt(selectedService.dataset.price);
            const duration = selectedService.dataset.duration;

            summaryService.textContent = serviceName;
            summaryTotal.textContent = formatRupiah(price);
            summaryDP.textContent = formatRupiah(price / 2);
            summaryDuration.textContent = duration + " menit";
        } else {
            summaryService.textContent = "-";
            summaryTotal.textContent = "Rp 0";
            summaryDP.textContent = "Rp 0";
            summaryDuration.textContent = "-";
        }

        // ========================
        // BARBER
        // ========================
        const selectedBarber = document.querySelector(
            'input[name="barber"]:checked',
        );

        if (selectedBarber) {
            const barberCard = selectedBarber.closest(".option-card");
            summaryBarber.textContent =
                barberCard.querySelector(".option-title").textContent;
        } else {
            summaryBarber.textContent = "-";
        }

        // ========================
        // PAYMENT
        // ========================
        const selectedPayment = document.querySelector(
            'input[name="payment"]:checked',
        );

        if (selectedPayment) {
            const paymentCard = selectedPayment.closest(".option-card");
            summaryPayment.textContent =
                paymentCard.querySelector(".option-title").textContent;
        } else {
            summaryPayment.textContent = "-";
        }

        // ========================
        // DATE
        // ========================
        if (dateInput.value) {
            const date = new Date(dateInput.value);
            summaryDate.textContent = date.toLocaleDateString("id-ID", {
                weekday: "long",
                year: "numeric",
                month: "long",
                day: "numeric",
            });
        } else {
            summaryDate.textContent = "-";
        }

        // ========================
        // TIME
        // ========================
        const selectedTime = document.querySelector(
            'input[name="bookingTime"]:checked',
        );

        if (selectedTime) {
            summaryTime.textContent = selectedTime.value;
        } else {
            summaryTime.textContent = "-";
        }
    }

    // ===================================
    // FORMAT RUPIAH FUNCTION
    // ===================================
    function formatRupiah(amount) {
        return "Rp " + parseInt(amount).toLocaleString("id-ID");
    }

    // ===================================
    // FORM VALIDATION & SUBMISSION
    // ===================================
    // bookingForm.addEventListener("submit", function (e) {
    //     e.preventDefault();

    //     // Basic Info
    //     const name = document.getElementById("fullName").value;
    //     const phone = document.getElementById("phone").value;

    //     // Selections
    //     const service = document.querySelector('input[name="service"]:checked');
    //     const barber = document.querySelector('input[name="barber"]:checked');
    //     const payment = document.querySelector('input[name="payment"]:checked');

    //     if (
    //         !service ||
    //         !barber ||
    //         !payment ||
    //         !dateInput.value ||
    //         !timeInput.value
    //     ) {
    //         alert(
    //             "❌ Mohon lengkapi semua pilihan booking, tanggal, dan waktu!",
    //         );
    //         return;
    //     }

    //     // Calculate DP
    //     const totalPrice = parseInt(service.getAttribute("data-price"));
    //     const dpPrice = totalPrice / 2;

    //     // Prepare Modal Data
    //     modalPaymentMethod.textContent = payment
    //         .closest(".option-card")
    //         .querySelector(".option-title").textContent;
    //     modalDPAmount.textContent = formatRupiah(dpPrice);

    //     // Set Account Info
    //     const payType = payment.value;
    //     qrisContainer.style.display = "none";

    //     if (payType === "bca") {
    //         modalAccountInfo.innerHTML =
    //             "Nomor Rekening BCA: **123-456-7890** <br> a/n KUGA BARBERSHOP";
    //     } else if (payType === "mandiri") {
    //         modalAccountInfo.innerHTML =
    //             "Nomor Rekening Mandiri: **987-654-3210** <br> a/n KUGA BARBERSHOP";
    //     } else if (payType === "gopay" || payType === "dana") {
    //         modalAccountInfo.innerHTML = `Nomor HP ${payType.toUpperCase()}: **0812-5662-6112** <br> a/n KUGA BARBERSHOP`;
    //     } else if (payType === "qris") {
    //         modalAccountInfo.innerHTML =
    //             "Silakan scan QR Code di bawah menggunakan aplikasi e-wallet Anda.";
    //         qrisContainer.style.display = "block";
    //     }

    //     // Show Payment Modal
    //     paymentModal.style.display = "block";
    // });

    // Close Modal
    // closePaymentModal.onclick = () => (paymentModal.style.display = "none");
    // window.onclick = (event) => {
    //     if (event.target == paymentModal) paymentModal.style.display = "none";
    // };

    // CONFIRM PAID BUTTON
    // confirmPaidBtn.addEventListener("click", function () {
    //     // 1. Close payment modal
    //     paymentModal.style.display = "none";

    //     // 2. Prepare Success State
    //     randomIdSpan.textContent = Math.floor(1000 + Math.random() * 9000);

    //     // 3. Trigger WhatsApp Message
    //     sendWhatsApp();

    //     // 4. Show Success Overlay
    //     successOverlay.style.display = "flex";
    // });

    function sendWhatsApp() {
        const name = document.getElementById("fullName").value;
        const phone = document.getElementById("phone").value;
        const serviceName = document
            .querySelector('input[name="service_id"]:checked')
            .closest(".option-card")
            .querySelector(".option-title").textContent;
        const barberName = document
            .querySelector('input[name="barber"]:checked')
            .closest(".option-card")
            .querySelector(".option-title").textContent;
        const paymentName = document
            .querySelector('input[name="payment"]:checked')
            .closest(".option-card")
            .querySelector(".option-title").textContent;
        const totalPrice = parseInt(
            document
                .querySelector('input[name="service_id"]:checked')
                .getAttribute("data-price"),
        );
        const dpPrice = totalPrice / 2;
        const date = summaryDate.textContent;
        const time = timeInput.value;
        const notes = document.getElementById("notes").value || "-";

        const message = `
*KONFIRMASI PEMBAYARAN DP - KUGA BARBERSHOP*
---------------------------------------
👤 *Nama:* ${name}
📱 *WhatsApp:* ${phone}
---
✂️ *Layanan:* ${serviceName}
💈 *Barber:* ${barberName}
📅 *Jadwal:* ${date} (${time})
---
💳 *Metode DP:* ${paymentName}
💰 *Total Harga:* ${formatRupiah(totalPrice)}
🪙 *DP Dibayar:* ${formatRupiah(dpPrice)}
---
📝 *Catatan:* ${notes}

*Status: PEMBAYARAN SELESAI (Bukti terlampir)*
_Mohon instruksi selanjutnya, terima kasih!_
        `.trim();

        const waUrl = `https://wa.me/6281256626112?text=${encodeURIComponent(message)}`;
        window.open(waUrl, "_blank");
    }
});
