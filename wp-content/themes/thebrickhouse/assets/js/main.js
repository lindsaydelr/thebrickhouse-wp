/*! For license information please see main.js.LICENSE.txt */
!function(){var e={741:function(){window.addEventListener("keydown",(function e(t){9===t.keyCode&&(document.body.classList.add("user-is-tabbing"),window.removeEventListener("keydown",e))}))},631:function(){document.querySelector("#mobile-nav-open-button").addEventListener("click",(function(){document.body.classList.add("nav-is-open"),document.querySelector("#mobile-nav-open-button").ariaExpanded=!0,document.querySelector("#mobile-nav").classList.remove("mobile-nav--hidden"),document.querySelector("#mobile-nav").ariaHidden=!1})),document.querySelector("#mobile-nav-close-button").addEventListener("click",(function(){document.body.classList.remove("nav-is-open"),document.querySelector("#mobile-nav-open-button").ariaExpanded=!1,document.querySelector("#mobile-nav").classList.add("mobile-nav--hidden"),document.querySelector("#mobile-nav").ariaHidden=!0}))},145:function(){var e,t=document.querySelector("#header-publications-nav");t.addEventListener("mouseover",(function(){clearTimeout(e),t.classList.add("nav-is-open")})),t.addEventListener("mouseout",(function(){e=setTimeout((function(){t.classList.remove("nav-is-open")}),300)})),document.querySelector("#publications-nav-close-button").addEventListener("click",(function(){t.classList.remove("nav-is-open")}))}},t={};function n(o){if(t[o])return t[o].exports;var i=t[o]={exports:{}};return e[o](i,i.exports,n),i.exports}!function(){"use strict";n(741);function e(){for(var e=0,t=0,n=arguments.length;t<n;t++)e+=arguments[t].length;var o=Array(e),i=0;for(t=0;t<n;t++)for(var r=arguments[t],a=0,d=r.length;a<d;a++,i++)o[i]=r[a];return o}(function(t,n){void 0===n&&(n="js-reframe"),("string"==typeof t?e(document.querySelectorAll(t)):"length"in t?e(t):[t]).forEach((function(e){var t,o;if(!(-1!==e.className.split(" ").indexOf(n)||e.style.width.indexOf("%")>-1)){var i=e.getAttribute("height")||e.offsetHeight,r=e.getAttribute("width")||e.offsetWidth,a=("string"==typeof i?parseInt(i):i)/("string"==typeof r?parseInt(r):r)*100,d=document.createElement("div");d.className=n;var s=d.style;s.position="relative",s.width="100%",s.paddingTop=a+"%";var c=e.style;c.position="absolute",c.width="100%",c.height="100%",c.left="0",c.top="0",null===(t=e.parentNode)||void 0===t||t.insertBefore(d,e),null===(o=e.parentNode)||void 0===o||o.removeChild(e),d.appendChild(e)}}))})("iframe");n(631),n(145)}()}();