 
 
 export function sideScroller () {

  

  const topMarquee = document.querySelector("#top-stripe .scrolling-text");
  
  const bottomMarquee = document.querySelector("#bottom-stripe .scrolling-text");

  function updatePosition(currentX, wrapWidth) {
    const numericX = parseFloat(currentX);
    if (numericX <= -wrapWidth) return "0px";
    if (numericX > 0) return -wrapWidth + "px";
    return numericX + "px";
  }

  function startMarquee(element, duration, direction) {
    const width = element.scrollWidth;
    let startX = 0;
    let endX = -width;

    if (direction !== "left") {
      startX = -width;
      endX = 0;
    }

    function modifyX(nextX) {
      return updatePosition(nextX, width);
    }

    gsap.set(element, { x: startX });
    gsap.to(element, {
      x: endX,
      duration: duration,
      ease: "none",
      repeat: -1,
      modifiers: {
        x: modifyX
      }
    });
  }

  if (topMarquee) startMarquee(topMarquee, 20, "left");
  if (bottomMarquee) startMarquee(bottomMarquee, 20, "right");
 }