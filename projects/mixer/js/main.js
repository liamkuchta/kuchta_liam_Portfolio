console.log("JavaScript is connected");

//variables

const buttonPause = document.querySelector("#pause");
const buttonStop = document.querySelector("#stop");
const buttonPlay = document.querySelector("#play");
const buttonReset = document.querySelector("#reset");
const soundsDiv = document.querySelector("#sounds1");
const recordDisc = document.querySelector("#record-disc");
const dropAreas = document.querySelectorAll(".drop-area");
const sounds = document.querySelectorAll(".single-sound");
let currentDraggedElement = null;
let playing = [];
let reorderSounds = [];

//functions

function dragStart() {
    currentDraggedElement = this;
  }

function dragOver(event) {
    event.preventDefault();
  }

function drop(event) {
    event.preventDefault();
    this.classList.remove("hovering");

// it doesn't srop in a box that has a sound    
    if (this.querySelector(".single-sound")) return;
    this.appendChild(currentDraggedElement);
    currentDraggedElement = null;
    const droppedAudios = [];
    document.querySelectorAll(".drop-area .single-sound").forEach((p) => {
      const soundId = p.getAttribute("data-sound");
      const audioEl = document.getElementById(soundId);
      if (audioEl) {
        droppedAudios.push(audioEl);
      }
    });
    droppedAudios.forEach((audio) => {
      audio.pause();
      audio.currentTime = 0;
    });
// all our sounds play from the start    
    droppedAudios.forEach((audio) => audio.play());
    playing = droppedAudios;
  }

function resetMixer() {
    
    const topContainer = document.querySelector("#sounds1");
    const allSounds = document.querySelectorAll(".single-sound");
  
    allSounds.forEach(function(sound) {
      topContainer.appendChild(sound);
      sound.setAttribute("draggable", "true");
    });

    document.querySelectorAll("audio").forEach(audio => {
      audio.pause();
      audio.currentTime = 0;
    });
  
    playing = [];
}

function dragEnter(event) {
    event.preventDefault();
    this.classList.add("hovering");
}
  
function dragLeave() {
    this.classList.remove("hovering");
}

sounds.forEach(function(sound) {
  reorderSounds.push(sound.parentElement);
});

function playAll() {
  playing.forEach(function(audio) {
    audio.play();
  });
}

function pauseAll() {
  playing.forEach(function(audio) {
    audio.pause();
  });
}

function stopAll() {
  playing.forEach(function(audio) {
    audio.pause();
    audio.currentTime = 0;
  });
}

//Event listeners

sounds.forEach(function(sound) {
  sound.addEventListener("dragstart", dragStart);
});

dropAreas.forEach(function(area) {
  area.addEventListener("dragover", dragOver);
  area.addEventListener("dragenter", dragEnter);
  area.addEventListener("dragleave", dragLeave);
  area.addEventListener("drop", drop);
});

buttonPlay.addEventListener("click", playAll);
buttonPause.addEventListener("click", pauseAll);
buttonStop.addEventListener("click", stopAll);
buttonReset.addEventListener("click", resetMixer);