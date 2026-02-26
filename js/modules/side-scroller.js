 
 
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
    const startX = direction === "left" ? 0 : -width;
    const endX = direction === "left" ? -width : 0;
    gsap.set(element, { x: startX });
    gsap.to(element, {
      x: endX,
      duration: duration,
      ease: "none",
      repeat: -1,
      modifiers: {
        x: function(nextX) { return updatePosition(nextX, width); }
      }
    });
  }

  if (topMarquee) startMarquee(topMarquee, 20, "left");
  if (bottomMarquee) startMarquee(bottomMarquee, 20, "right");
 }