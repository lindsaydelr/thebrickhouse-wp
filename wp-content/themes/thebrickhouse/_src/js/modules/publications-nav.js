/**
 * Open and close mobile nav.
 */

var publicationsNav = document.querySelector('#header-publications-nav');
var mouseOverTimeout;

publicationsNav.addEventListener('mouseover', () => {
  clearTimeout(mouseOverTimeout);
  publicationsNav.classList.add('nav-is-open');
});

publicationsNav.addEventListener('mouseout', () => {
  mouseOverTimeout = setTimeout(() => {
    publicationsNav.classList.remove('nav-is-open');
  }, 300);
});

document.querySelector('#publications-nav-close-button').addEventListener('click', () => {
  publicationsNav.classList.remove('nav-is-open');
});
