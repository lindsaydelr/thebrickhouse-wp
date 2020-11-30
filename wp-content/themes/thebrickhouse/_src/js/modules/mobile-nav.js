/**
 * Open and close mobile nav.
 */
document.querySelector('#mobile-nav-open-button').addEventListener('click', () => {
  document.body.classList.add('nav-is-open');
  document.querySelector('#mobile-nav-open-button').ariaExpanded = true;
  document.querySelector('#mobile-nav').classList.remove('mobile-nav--hidden');
  document.querySelector('#mobile-nav').ariaHidden = false;
});

document.querySelector('#mobile-nav-close-button').addEventListener('click', () => {
  document.body.classList.remove('nav-is-open');
  document.querySelector('#mobile-nav-open-button').ariaExpanded = false;
  document.querySelector('#mobile-nav').classList.add('mobile-nav--hidden');
  document.querySelector('#mobile-nav').ariaHidden = true;
});
