// Add a 'user-is-tabbing' class to the body so we can recognize when the user
// is tabbing. Among other things, this can be used to remove element focus
// rings when the user is *not* tabbing.
const handleTabKey = (event) => {
  const tabKeyCode = 9;
  if (event.keyCode === tabKeyCode) {
    document.body.classList.add('user-is-tabbing');
    window.removeEventListener('keydown', handleTabKey);
  }
}

window.addEventListener('keydown', handleTabKey);
