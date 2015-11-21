/* eslint-env browser */
/* eslint-disable no-console */
function showMenu(e) {
  e.preventDefault();

  var menu = document.getElementById('nav');

  if(menu.classList.contains('navigation--active')) {
    menu.classList.remove('navigation--active');
  } else {
    menu.classList.add('navigation--active');
  }
}

function videoOnResizer() {
  var videos = document.querySelectorAll('iframe');

  for (var i = 0; i < videos.length; i++) {
    var video = videos.item(i);
    var h = video.getAttribute('height');
    var w = video.getAttribute('width');

    video.setAttribute('data-aspect', w / h);
  }

  return function onResize() {
    for (var j = 0; j < videos.length; j++) {
      var v = videos.item(j);
      var parent = v.parentElement;

      var clientWidth = parent.clientWidth;
      var style = window.getComputedStyle(parent);
      var padding = parseFloat(style.paddingLeft) + parseFloat(style.paddingRight);
      var width = clientWidth - padding;

      var aspect = v.getAttribute('data-aspect');
      v.setAttribute('width', width);
      v.setAttribute('height', width / aspect);
    }
  };
}

// onready equiv
(function() {
  document.getElementById('nav-toggler').addEventListener('click', showMenu);
  
  var resizer = videoOnResizer();
  window.onresize = resizer;
  resizer();

  console.log(
    '%cThe Aristocats like web developers. You should join us. 😻😻',
    'font-weight: bold;'
  );

  console.log('There\'s no real call for intense JS on this page so I\'m just gonna log to the console.');
  console.log('meow meow meow meow meow meow');

})();
