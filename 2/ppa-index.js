var mybutton = document.getElementById("myBtn");

// When the user scrolls down 120px from the top of the document, show the button
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 120 || document.documentElement.scrollTop > 120) {
    mybutton.style.display = "block";
  } else {
    mybutton.style.display = "none";
  }
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
}

const form = document.querySelector("#contact-form");
form.addEventListener("submit", function (e) {
  e.preventDefault();

  const hcaptchaVal = document.querySelector('[name=h-captcha-response]').value;

  if (!hcaptchaVal || hcaptchaVal === "") {
      e.preventDefault();
      alert("Please complete the hCaptcha");
   } else {
      const formData = new FormData(this);
    
      fetch('contact.php', {
        method: 'post',
        body: formData
      }).then(function(text) {
        alert('Wiadomość wysłana');
      }).catch(function(error) {
        alert(error)
      });
   }

});

