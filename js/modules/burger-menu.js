export function burgerMenu() {
 const navToggle = document.querySelector('#navToggle');
  const navMenu = document.querySelector('#navMenu');

  function toggleNavMenu() {
      navMenu.classList.toggle('running');
      navToggle.classList.toggle('running');
  }

  function closeNavMenu() {
      navMenu.classList.remove('running');
      navToggle.classList.remove('running');
  }

  function closeNavMenuOnClickOutside(e) {
      if (!navToggle.contains(e.target) && !navMenu.contains(e.target)) {
          closeNavMenu();
      }
  }

  if (navToggle && navMenu) {
      navToggle.addEventListener('click', toggleNavMenu);

      const navLinks = navMenu.querySelectorAll('a');
      navLinks.forEach(link => {
          link.addEventListener('click', closeNavMenu);
      });

      document.addEventListener('click', closeNavMenuOnClickOutside);
  }
}