"use strict";!function(){document.addEventListener("DOMContentLoaded",function(){console.log("Ready"),console.log(document.querySelectorAll(".nav-burger"));var e=Array.prototype.slice.call(document.querySelectorAll(".navbar-burger"),0);console.log(e),e.length>0&&e.forEach(function(e){e.addEventListener("click",function(){var t=e.dataset.target,o=document.getElementById(t);e.classList.toggle("is-active"),o.classList.toggle("is-active")})})})}();