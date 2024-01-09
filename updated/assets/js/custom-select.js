var x, i, j, l, ll, selElmnt, a, b, c;
/* Look for any elements with the class "custom-select": */
x = document.getElementsByClassName("custom-select-box");
l = x.length;
for (i = 0; i < l; i++) {
  selElmnt = x[i].getElementsByTagName("select")[0];
  ll = selElmnt.length;
  /* For each element, create a new DIV that will act as the selected item: */
  a = document.createElement("DIV");
  a.setAttribute("class", "select-selected");
  a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
  x[i].appendChild(a);
  /* For each element, create a new DIV that will contain the option list: */
  b = document.createElement("DIV");
  b.setAttribute("class", "select-items select-hide");
  for (j = 1; j < ll; j++) {
    /* For each option in the original select element,
    create a new DIV that will act as an option item: */
    c = document.createElement("DIV");
    c.innerHTML = selElmnt.options[j].innerHTML;
    c.addEventListener("click", function(e) {
        /* When an item is clicked, update the original select box,
        and the selected item: */
        var y, i, k, s, h, sl, yl;
        s = this.parentNode.parentNode.getElementsByTagName("select")[0];
        sl = s.length;
        h = this.parentNode.previousSibling;
        for (i = 0; i < sl; i++) {
          if (s.options[i].innerHTML == this.innerHTML) {
            s.selectedIndex = i;
            h.innerHTML = this.innerHTML;
            y = this.parentNode.getElementsByClassName("same-as-selected");
            yl = y.length;
            for (k = 0; k < yl; k++) {
              y[k].removeAttribute("class");
            }
            this.setAttribute("class", "same-as-selected");
            break;
          }
        }
        h.click();
    });
    b.appendChild(c);
  }
  x[i].appendChild(b);
  a.addEventListener("click", function(e) {
    /* When the select box is clicked, close any other select boxes,
    and open/close the current select box: */
    e.stopPropagation();
    closeAllSelect(this);
    this.nextSibling.classList.toggle("select-hide");
    this.classList.toggle("select-arrow-active");
  });
}

function closeAllSelect(elmnt) {
  /* A function that will close all select boxes in the document,
  except the current select box: */
  var x, y, i, xl, yl, arrNo = [];
  x = document.getElementsByClassName("select-items");
  y = document.getElementsByClassName("select-selected");
  xl = x.length;
  yl = y.length;
  for (i = 0; i < yl; i++) {
    if (elmnt == y[i]) {
      arrNo.push(i)
    } else {
      y[i].classList.remove("select-arrow-active");
    }
  }
  for (i = 0; i < xl; i++) {
    if (arrNo.indexOf(i)) {
      x[i].classList.add("select-hide");
    }
  }
}

/* If the user clicks anywhere outside the select box,
then close all select boxes: */
document.addEventListener("click", closeAllSelect);




//second select box

//   const sliderValue = document.getElementById("dis_price");
//     const slidersValue = document.getElementById("max_price");
   
// const slider = document.getElementById("mydRange");
// const sliders = document.getElementById("myRange");

// const min = slider.min;
// const max = slider.max;

// const value = slider.value;

// slider.style.background = `linear-gradient(to right, #f36022 0%, #f36022 ${(value - min) / (max - min) * 100}%, #DEE2E6 ${(value - min) / (max - min) * 100}%, #DEE2E6 100%)`;

// slider.oninput = function () {
//   this.style.background = `linear-gradient(to right, #f36022 0%, #f36022 ${(this.value - min) / (max - min) * 100}%, #DEE2E6 ${(this.value - min) / (max - min) * 100}%, #DEE2E6 100%)`;
// };

// slider.addEventListener("input", function () {
//   sliderValue.textContent = this.value;
// });

// sliders.addEventListener("input", function () {
//   const minn = this.min;
//   const maxx = this.max;

//   this.style.background = `linear-gradient(to right, #f36022 0%, #f36022 ${(this.value - minn) / (maxx - minn) * 100}%, #DEE2E6 ${(this.value - minn) / (maxx - minn) * 100}%, #DEE2E6 100%)`;
// });

// sliders.addEventListener("input", function () {
//   slidersValue.textContent = this.value;
// });



const sliderValue = document.getElementById("dis_price");
    const slidersValue = document.getElementById("max_price");
    const slider = document.getElementById("mydRange");
    const sliders = document.getElementById("myRange");
    const min = slider.min;
    const max = slider.max;
    const minn = sliders.min;
    const maxx = sliders.max;

    const updateSliderBackground = (element, min, max) => {
      const value = element.value;
      element.style.background = `linear-gradient(to right, #f36022 0%, #f36022 ${(value - min) / (max - min) * 100}%, #DEE2E6 ${(value - min) / (max - min) * 100}%, #DEE2E6 100%)`;
    };

    const handleSliderInput = (element, valueDisplay) => {
      element.addEventListener("input", function () {
        updateSliderBackground(this, this.min, this.max);
        valueDisplay.textContent = this.value;
        // Store the current slider value in localStorage
        localStorage.setItem(element.id, this.value);
      });
    };

    // Get and set the stored values from localStorage
    const storedValue1 = localStorage.getItem("mydRange");
    const storedValue2 = localStorage.getItem("myRange");

    if (storedValue1) {
      slider.value = storedValue1;
      sliderValue.textContent = storedValue1;
      setTimeout(() => {
        updateSliderBackground(slider, min, max);
      }, 0);
    }

    if (storedValue2) {
      sliders.value = storedValue2;
      slidersValue.textContent = storedValue2;
      setTimeout(() => {
        updateSliderBackground(sliders, minn, maxx);
      }, 0);
    }

    // Attach event handlers to the sliders
    handleSliderInput(slider, sliderValue);
    handleSliderInput(sliders, slidersValue);

