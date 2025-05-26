window.onload = function () {
  var focusElem = document.getElementById('focus');
  if (focusElem) {
    focusElem.scrollIntoView({ behavior: 'smooth', block: 'center' });
  }
};