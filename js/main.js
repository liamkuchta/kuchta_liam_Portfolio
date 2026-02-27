import {burgerMenu} from "./modules/burger-menu.js";
import {scrollTriggers} from "./modules/scroll-triggers.js";
import {sideScroller} from "./modules/side-scroller.js";
import {initContactForm} from "./modules/contact-form.js";

// initialize when DOM is ready to ensure elements exist
document.addEventListener('DOMContentLoaded', () => {
  burgerMenu();
  scrollTriggers();
  sideScroller();
  initContactForm();
});


// (() => { 
//   console.log("JavaScript File is linked");

//   const navToggle = document.querySelector('#navToggle');
//   const navMenu = document.querySelector('#navMenu');

//   function toggleNavMenu() {
//       navMenu.classList.toggle('running');
//       navToggle.classList.toggle('running');
//   }

//   function closeNavMenu() {
//       navMenu.classList.remove('running');
//       navToggle.classList.remove('running');
//   }

//   function closeNavMenuOnClickOutside(e) {
//       if (!navToggle.contains(e.target) && !navMenu.contains(e.target)) {
//           closeNavMenu();
//       }
//   }

//   if (navToggle && navMenu) {
//       navToggle.addEventListener('click', toggleNavMenu);

//       const navLinks = navMenu.querySelectorAll('a');
//       navLinks.forEach(link => {
//           link.addEventListener('click', closeNavMenu);
//       });

//       document.addEventListener('click', closeNavMenuOnClickOutside);
//   }

//   // SIDE SCROLLING MARQUEES
//   const topMarquee = document.querySelector("#top-stripe .scrolling-text");
//   const bottomMarquee = document.querySelector("#bottom-stripe .scrolling-text");

//   function updatePosition(currentX, wrapWidth) {
//     const numericX = parseFloat(currentX);
//     if (numericX <= -wrapWidth) return "0px";
//     if (numericX > 0) return -wrapWidth + "px";
//     return numericX + "px";
//   }

//   function startMarquee(element, duration, direction) {
//     const width = element.scrollWidth;
//     const startX = direction === "left" ? 0 : -width;
//     const endX = direction === "left" ? -width : 0;
//     gsap.set(element, { x: startX });
//     gsap.to(element, {
//       x: endX,
//       duration: duration,
//       ease: "none",
//       repeat: -1,
//       modifiers: {
//         x: function(nextX) { return updatePosition(nextX, width); }
//       }
//     });
//   }

//   if (topMarquee) startMarquee(topMarquee, 20, "left");
//   if (bottomMarquee) startMarquee(bottomMarquee, 20, "right");

// })();

// // projects ScrollTrigger Animations
// (function() {
//   gsap.registerPlugin(ScrollTrigger);

//   function animateHeroBox() {
//     gsap.fromTo(".project-hero-box",
//       { opacity: 0, y: 50 },
//       { opacity: 1, y: 0, duration: 1.2, ease: "power2.out" }
//     );
//   }

//   function animateSections() {
//     const sections = document.querySelectorAll(".single-project-section .col-span-full");
//     sections.forEach(function(section) {
//       gsap.from(section, {
//         scrollTrigger: {
//           trigger: section,
//           start: "top 80%",
//           toggleActions: "play none none none"
//         },
//         opacity: 0,
//         y: 50,
//         duration: 1,
//         ease: "power2.out"
//       });
//     });
//   }

//   function animateMockup() {
//     const mockup = document.querySelector(".project-mockup-large");
//     if (mockup) {
//       gsap.from(mockup, {
//         scrollTrigger: {
//           trigger: mockup,
//           start: "top 85%",
//           toggleActions: "play none none none"
//         },
//         opacity: 0,
//         y: 100,
//         scale: 0.9,
//         duration: 1.2,
//         ease: "power2.out"
//       });
//     }
//   }

//   function animateFooter() {
//     const footer = document.querySelector("footer");
//     if (footer) {
//       gsap.from(footer, {
//         scrollTrigger: {
//           trigger: footer,
//           start: "top 90%",
//           toggleActions: "play none none none"
//         },
//         opacity: 0,
//         y: 50,
//         duration: 1,
//         ease: "power2.out"
//       });
//     }
//   }

//   animateHeroBox();
//   animateSections();
//   animateMockup();
//   animateFooter();

// })();


