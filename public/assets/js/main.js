document.addEventListener('DOMContentLoaded', () => {
  "use strict";

  const preloader = document.querySelector('#preloader');
  if (preloader) {
    window.addEventListener('load', () => {
      setTimeout(() => {
        preloader.remove();
      }, 300);
      
    });
  }
});