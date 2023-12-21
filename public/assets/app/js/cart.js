document.addEventListener('DOMContentLoaded', function () {
    var minusButton = document.querySelector('.minus');
    console.log(minusButton);
    var plusButton = document.querySelector('.plus');
    console.log(plusButton);
    var quantityInput = document.querySelector('input[type="text"]');
  
    minusButton.addEventListener('click', function () {
      var currentValue = parseInt(quantityInput.value);
      if (currentValue > 1) {
        quantityInput.value = currentValue - 1;
      }
    });
  
    plusButton.addEventListener('click', function () {
      var currentValue = parseInt(quantityInput.value);
      quantityInput.value = currentValue + 1;
    });
  });