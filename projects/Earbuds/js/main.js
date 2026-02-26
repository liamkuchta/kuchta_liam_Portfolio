

// NAV NAV NAV NAV NAV

console.log("JavaScript File is linked");

const navToggle = document.querySelector('#navToggle');
const navMenu = document.querySelector('#navMenu');


function toggleNavMenu() {
    console.log("toggle nav function called");
    navMenu.classList.toggle('running');
    navToggle.classList.toggle('running');
    console.log("Navigation menu toggled - running state:", navMenu.classList.contains('running'));
}

function closeNavMenu() {
    console.log("close nav function called");
    navMenu.classList.remove('running');
    navToggle.classList.remove('running');
    console.log("Navigation menu closed");
}

function closeNavMenuOnClickOutside(e) {
    console.log("click outside nav function called");
    if (!navToggle.contains(e.target) && !navMenu.contains(e.target)) {
        console.log("clicked outside of nav");
        closeNavMenu();
    } else {
        console.log("clicked inside nav, menu stays open");
    }
}

// event listeners
if (navToggle && navMenu) {
    console.log("nav elements found ");
    
    navToggle.addEventListener('click', toggleNavMenu);
    console.log("toggle button event listener added");

    const navLinks = navMenu.querySelectorAll('a');
    console.log("found", navLinks.length, "nav links");
    
    navLinks.forEach(link => {
        link.addEventListener('click', closeNavMenu);
    });
    console.log("nav link event listeners added");

    document.addEventListener('click', closeNavMenuOnClickOutside);
    console.log("document click event listener added");
    
} else {
    console.log("nav elements not found");
}



(() => {
  const hotspots = document.querySelectorAll(".Hotspot");

  const infoFeatures = [
    {
      image: "images/mute.png",
      title: "NOISE CANCELLING",
      text: "Advanced noise-cancelling technology blocks out background sounds so you can focus completely on your music or calls."

    },
    {
      image: "images/earpiece.png",
      title: "LUXURY EARPIECE",
      text: "A soft, flexible silicone earpiece that gently seals in your ear for a snug, comfortable fit and all-day listening ease."

    },
    {
      image: "images/signal.png",
      title: "SPACE ANTENNA",
      text: "Receive signals from alien intelligence with new break through deep space theta wave technology."
    }
  
  ]

//functions

  function loadInfo() {
    infoFeatures.forEach((infoFeature, index)=>{
      // console.log(index+1);
      //selected will be the inforBox on our page, e.g.hotspot-1, hotspot-2, etc.
      let selected = document.querySelector(`#hotspot-${index+1}`);
      console.log(selected);

      //lets create an img
      const imageElement = document.createElement('img');
      //lets populate the img
      imageElement.src = infoFeature.image;

      //lets create an h2
      const titleElement = document.createElement('h2');
      //lets populate the h2
      titleElement.textContent = infoFeature.title;

      //lets create a p
      const textElement = document.createElement('p');
      //lets populate the p
      textElement.textContent = infoFeature.text;

      //lets add the img to the selected hotspot
      selected.appendChild(imageElement);
      //lets add the h2 to the selected hotspot
      selected.appendChild(titleElement);
      //lets add the p to the selected hotspot
      selected.appendChild(textElement);

    });
  }
  loadInfo();

   function displayInfo() {
    //console.log(this.slot);
    //console.log(`#${this.slot}`);
    //since the slot value matches the id value I can use the slot value as a selector to get to the div I want.
    let selected = document.querySelector(`#${this.slot}`);
    gsap.to(selected, { duration: 1, autoAlpha: 1 });
  }

  function hideInfo() {
    //console.log(this.slot);
    //console.log(`#${this.slot}`);
    let selected = document.querySelector(`#${this.slot}`);
    gsap.to(selected, { duration: 1, autoAlpha: 0 });
  }
  
 hotspots.forEach(function (hotspot) {
    hotspot.addEventListener("mouseenter", displayInfo);
    hotspot.addEventListener("mouseleave", hideInfo);
  });

})();

// In this version, the event listeners use regular functions instead of arrow functions, so the "this" keyword inside the event listeners will refer to the DOM element that triggered the event.








// SCROLL ANIMATION SCROLL ANIMATION SCROLL ANIMATION SCROLL ANIMATION SCROLL ANIMATION 

(()=> {
  console.log("IIFE Called");

  const canvasBox = document.querySelector("#explode-view");
  const context = canvasBox.getContext("2d");

  canvasBox.width= 1920;
  canvasBox.height = 1080;

  //How many still frames do we have, you will need to adjust this
  const frameCount = 314; 

  //array to hold our images
  const photos = [];

  //object will hold the current frame
  //we will use GreenSock to animate the frame property
  const buds = {
      frame: 0
  }

  //Run a for loop to populate images array
  for (let i=0; i<frameCount; i++) {
      const img = new Image();
      img.src = `images/render1_${i.toString().padStart(5, '0')}.webp`;
      photos.push(img);
  }
  console.log(photos);


 

  gsap.to(buds, {
      frame: 314,
      snap: "frame",
      scrollTrigger: {
          trigger: "#explode-view",
          pin: true,
          scrub: 1,
          start: "top top",
          markers: true,
          
      },
      onUpdate: render
  })

  photos[0].addEventListener("load", render);

  function render() {
      //console.log(buds.frame);
      //console.log(images[buds.frame]);
      context.clearRect(0,0, canvasBox.width, canvasBox.height);
      context.drawImage(photos[buds.frame], 0, 0);
  }

})();




// SLIDER SLIDER SLIDER SLIDER SLIDER SLIDER SLIDER SLIDER 

(() => {

  const splitLine = document.querySelector("#divisor");
  const slideHandle = document.querySelector("#slider");

  function moveLine() {
      // console.log(slider.value);
      splitLine.style.width = `${slideHandle.value}%`;
  }

  function resetXray() {
    slideHandle.value = 50;
  }

  slideHandle.addEventListener("input", moveLine);
  window.addEventListener("load", resetXray);
})();


// TEXT FADE IN

gsap.registerPlugin(ScrollTrigger);

gsap.utils.toArray("p").forEach((text) => {
  gsap.from(text, {
    opacity: 0,
    y: 30,
    duration: 1,
    scrollTrigger: {
      trigger: text
    }
  });
});
