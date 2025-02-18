jQuery(function ($) {});
document.addEventListener("DOMContentLoaded", () => {
    const fadeElements = document.querySelectorAll(".fade-in");

    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add("active");
                }
            });
        },
        {
            threshold: 0.2, // 要素が20%表示されたら発火
        }
    );

    fadeElements.forEach((element) => {
        observer.observe(element);
    });
});
