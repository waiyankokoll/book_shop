/*!
* Start Bootstrap - Shop Homepage v5.0.6 (https://startbootstrap.com/template/shop-homepage)
* Copyright 2013-2023 Start Bootstrap
* Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-shop-homepage/blob/master/LICENSE)
*/
// This file is intentionally blank
// Use this file to add JavaScript to your project

  // Radio buttons
  const creditCardRadio = document.getElementById("creditCard");
  const kbzPayRadio = document.getElementById("kbzPay");
  const wavePayRadio = document.getElementById("wavePay");

  // The input div to show/hide
  const creditCardInput = document.getElementById("creditCardInput");

  // Function to check selected payment method
  function toggleCreditCardInput() {
    if (creditCardRadio.checked) {
      creditCardInput.classList.remove("d-none"); // Show if credit card selected
    } else {
      creditCardInput.classList.add("d-none");    // Hide otherwise
    }
  }

  // Add change event listeners
  creditCardRadio.addEventListener("change", toggleCreditCardInput);
  kbzPayRadio.addEventListener("change", toggleCreditCardInput);
  wavePayRadio.addEventListener("change", toggleCreditCardInput);

