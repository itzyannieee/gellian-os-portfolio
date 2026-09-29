document.addEventListener("DOMContentLoaded", function () {

    const typingText = document.getElementById("typingText");

    if (typingText) {
        const words = [
            "Information Technology Student",
            "Creative Learner",
            "Future IT Professional"
        ];

        let wordIndex = 0;
        let letterIndex = 0;
        let deleting = false;

        function typeEffect() {
            const currentWord = words[wordIndex];

            if (!deleting) {
                typingText.textContent =
                    currentWord.substring(0, letterIndex + 1);

                letterIndex++;

                if (letterIndex === currentWord.length) {
                    deleting = true;

                    setTimeout(typeEffect, 1500);
                    return;
                }

            } else {
                typingText.textContent =
                    currentWord.substring(0, letterIndex - 1);

                letterIndex--;

                if (letterIndex === 0) {
                    deleting = false;
                    wordIndex++;

                    if (wordIndex === words.length) {
                        wordIndex = 0;
                    }
                }
            }

            setTimeout(
                typeEffect,
                deleting ? 50 : 90
            );
        }

        typeEffect();
    }


    const themeToggle =
        document.getElementById("themeToggle");

    const savedTheme =
        localStorage.getItem("gellianTheme");

    if (savedTheme === "dark") {
        document.body.classList.add("dark-mode");

        if (themeToggle) {
            themeToggle.textContent = "☀";
        }
    }

    if (themeToggle) {
        themeToggle.addEventListener("click", function () {

            document.body.classList.toggle("dark-mode");

            if (
                document.body.classList.contains("dark-mode")
            ) {
                localStorage.setItem(
                    "gellianTheme",
                    "dark"
                );

                themeToggle.textContent = "☀";

            } else {
                localStorage.setItem(
                    "gellianTheme",
                    "light"
                );

                themeToggle.textContent = "◐";
            }

        });
    }


    const currentPage =
        window.location.pathname.split("/").pop();

    const navLinks =
        document.querySelectorAll("nav a");

    navLinks.forEach(function (link) {

        const linkPage =
            link.getAttribute("href");

        if (
            linkPage === currentPage ||
            (
                currentPage === "" &&
                linkPage === "index.html"
            )
        ) {
            link.classList.add("active");
        }

    });


    const mobileMenuButton =
        document.getElementById("mobileMenuButton");

    const mainNav =
        document.querySelector(".main-nav");

    if (mobileMenuButton && mainNav) {

        mobileMenuButton.addEventListener(
            "click",
            function () {

                mainNav.classList.toggle("mobile-open");

                if (
                    mainNav.classList.contains("mobile-open")
                ) {
                    mobileMenuButton.textContent = "×";
                } else {
                    mobileMenuButton.textContent = "☰";
                }

            }
        );

        mainNav.querySelectorAll("a").forEach(function (link) {

            link.addEventListener("click", function () {

                mainNav.classList.remove("mobile-open");
                mobileMenuButton.textContent = "☰";

            });

        });

    }


    const scrollButton =
        document.createElement("button");

    scrollButton.id = "scrollTopButton";
    scrollButton.innerHTML = "↑";

    scrollButton.setAttribute(
        "aria-label",
        "Scroll to top"
    );

    document.body.appendChild(scrollButton);

    window.addEventListener("scroll", function () {

        if (window.scrollY > 300) {
            scrollButton.classList.add("show");
        } else {
            scrollButton.classList.remove("show");
        }

    });

    scrollButton.addEventListener("click", function () {

        window.scrollTo({
            top: 0,
            behavior: "smooth"
        });

    });


    const contactForm =
        document.getElementById("contactForm");

    if (contactForm) {

        contactForm.addEventListener(
            "submit",
            function (event) {

                event.preventDefault();

                const name =
                    document.getElementById("name");

                const email =
                    document.getElementById("email");

                const message =
                    document.getElementById("message");

                const formMessage =
                    document.getElementById("formMessage");

                if (
                    !name ||
                    !email ||
                    !message ||
                    !formMessage
                ) {
                    return;
                }

                if (name.value.trim() === "") {

                    formMessage.textContent =
                        "Please enter your name.";

                    formMessage.className =
                        "form-error";

                    name.focus();

                    return;
                }

                if (email.value.trim() === "") {

                    formMessage.textContent =
                        "Please enter your email.";

                    formMessage.className =
                        "form-error";

                    email.focus();

                    return;
                }

                const emailPattern =
                    /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

                if (
                    !emailPattern.test(
                        email.value.trim()
                    )
                ) {

                    formMessage.textContent =
                        "Please enter a valid email address.";

                    formMessage.className =
                        "form-error";

                    email.focus();

                    return;
                }

                if (message.value.trim() === "") {

                    formMessage.textContent =
                        "Please enter your message.";

                    formMessage.className =
                        "form-error";

                    message.focus();

                    return;
                }

                formMessage.textContent =
                    "Message checked successfully! Thank you for reaching out.";

                formMessage.className =
                    "form-success";

                contactForm.reset();

            }
        );

    }


    const projectImages =
        document.querySelectorAll(".project-image");

    if (projectImages.length > 0) {

        const modal =
            document.createElement("div");

        modal.id = "imageModal";

        modal.innerHTML = `
            <div class="modal-content">

                <button
                    class="modal-close"
                    aria-label="Close image">
                    ×
                </button>

                <img
                    id="modalImage"
                    src=""
                    alt="Project preview">

            </div>
        `;

        document.body.appendChild(modal);

        const modalImage =
            document.getElementById("modalImage");

        const modalClose =
            document.querySelector(".modal-close");

        projectImages.forEach(function (image) {

            image.addEventListener("click", function () {

                modalImage.src = image.src;
                modalImage.alt = image.alt;

                modal.classList.add("show");

            });

        });

        modalClose.addEventListener("click", function () {

            modal.classList.remove("show");

        });

        modal.addEventListener("click", function (event) {

            if (event.target === modal) {
                modal.classList.remove("show");
            }

        });

        document.addEventListener("keydown", function (event) {

            if (
                event.key === "Escape" &&
                modal.classList.contains("show")
            ) {
                modal.classList.remove("show");
            }

        });

    }


    const filterButtons =
        document.querySelectorAll(".filter-button");

    const projectCards =
        document.querySelectorAll(".project-card");

    if (
        filterButtons.length > 0 &&
        projectCards.length > 0
    ) {

        filterButtons.forEach(function (button) {

            button.addEventListener("click", function () {

                filterButtons.forEach(function (item) {
                    item.classList.remove("active");
                });

                button.classList.add("active");

                const filter =
                    button.getAttribute("data-filter");

                projectCards.forEach(function (card) {

                    const category =
                        card.getAttribute("data-category");

                    if (
                        filter === "all" ||
                        category === filter
                    ) {
                        card.style.display = "block";
                    } else {
                        card.style.display = "none";
                    }

                });

            });

        });

    }

    console.log("GELLiAN OS loaded successfully.");

});