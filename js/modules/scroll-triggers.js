export function scrollTriggers () {
    gsap.registerPlugin(ScrollTrigger);

  function animateHeroBox() {
    gsap.fromTo(".project-hero-box",
      { opacity: 0, y: 50 },
      { opacity: 1, y: 0, duration: 1.2, ease: "power2.out" }
    );
  }


  //individual project section
  function animateSections() {
    const sections = document.querySelectorAll(".single-project-section .col-span-full");

    function animateSingleSection(section) {
      gsap.from(section, {
        scrollTrigger: {
          trigger: section,
          start: "top 80%",
          toggleActions: "play none none none"
        },
        opacity: 0,
        y: 50,
        duration: 1,
        ease: "power2.out"
      });
    }

    sections.forEach(animateSingleSection);
  }


  //project images
  function animateMockup() {
    const mockup = document.querySelector(".project-mockup-large");
    if (mockup) {
      gsap.from(mockup, {
        scrollTrigger: {
          trigger: mockup,
          start: "top 85%",
          toggleActions: "play none none none"
        },
        opacity: 0,
        y: 100,
        scale: 0.9,
        duration: 1.2,
        ease: "power2.out"
      });
    }
  }


  //footer
  function animateFooter() {
    const footer = document.querySelector("footer");
    if (footer) {
      gsap.from(footer, {
        scrollTrigger: {
          trigger: footer,
          start: "top 90%",
          toggleActions: "play none none none"
        },
        opacity: 0,
        y: 50,
        duration: 1,
        ease: "power2.out"
      });
    }
  }

  animateHeroBox();
  animateSections();
  animateMockup();
  animateFooter();

}