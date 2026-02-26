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






//TESTIMONIALS TESTIMONIALS TESTIMONIALS TESTIMONIALS TESTIMONIALS TESTIMONIALS TESTIMONIALS 


const clients = document.querySelector("#client-title");
const testiContainer = document.querySelector("#testimonial-con");
const testimonials = [
    { name: "Marco Deluca",  avatar: "me.png", testimonial: "Working with Liam was an absolute pleasure. He built a clean, responsive website that perfectly captured our brand and made updates easy for our team. Their communication, attention to detail, and problem-solving skills made the whole process smooth from start to finish."},
    { name: "Justin Brunner", avatar: "justin.png", testimonial: "I was amazed by Robin's creativity and technical skill. He transformed our outdated site into a modern, fast, and user-friendly experience. Every request was handled quickly, and the final result exceeded our expectations."},
    { name: "Joe Kormendi", avatar: "joe.png", testimonial: "Mikhail delivered exactly what we needed — a sleek, functional website that stands out. He understood our vision right away and turned it into a polished, high-quality product. I'd highly recommend them to anyone looking for a reliable and talented web developer." }
];

let count = 0;
const previous = document.querySelector("#previous");
const next = document.querySelector("#next");

function openTesti() {
    
    const testiDiv = document.createElement("div");
    testiDiv.classList.add("col-span-full", "m-col-span-7");
    const testimonialPerson = document.createElement("h3");
    const testimonialQuote = document.createElement("p");
    const testimonialAvatar = document.createElement("img");
    testimonialQuote.textContent = `"${testimonials[count].testimonial}"`;
    testimonialPerson.textContent = testimonials[count].name;
    testimonialAvatar.textContent = testimonials[count].avatar;
    testimonialAvatar.src = `images/${testimonials[count].avatar}`;
    testimonialAvatar.alt = `${testimonials[count].name}'s avatar`;
    testiContainer.innerHTML = "";
    testiDiv.appendChild(testimonialAvatar);
    testiDiv.appendChild(testimonialPerson);
    testiDiv.appendChild(testimonialQuote);
    testiContainer.appendChild(testiDiv);
}

function clickThrough() {   
    count++;
    if (count >= testimonials.length) {
        count = 0;
    }
    openTesti();
}

function lastTestimonial() {
    count--;
    if (count < 0) {
        count = testimonials.length-1;
    }
    openTesti();
}

openTesti();

next.addEventListener("click", clickThrough);
previous.addEventListener("click", lastTestimonial);






// PORTFOLIOS PORTFOLIOS PORTFOLIOS PORTFOLIOS PORTFOLIOS PORTFOLIOS PORTFOLIOS PORTFOLIOS 

const portfolioSection = document.querySelector("#portfolio-section");

const portfolios = [
    
   //1 
    {student: "Ajay Chakaravarthy Antony Raj", portLink: "Ajay Chakaravarthy.com"},
    {student: "Amy Armstrong", portLink: "Amy Armstrong.com"},
    {student: "Sydney Bandarra", portLink: "Sydney Bandarra.com"},
    {student: "Tapshveer Benipal", portLink: "Tapshveer Benipal.com"},
    {student: "Ezekiel John Celis", portLink: "Ezekiel John.com"},
//2
    {student: "Yi Cheng", portLink: "Yi Cheng.com"},
    {student: "Chanya Chumdee", portLink: "Chanya Chumdee.com"},
    {student: "Luciano Clementi", portLink: "Luciano Clementi.com"},
    {student: "Simon Dasilva", portLink: "Simon Dasilva.com"},
    {student: "Hansini Chetan Dhameliya", portLink: "Hansini Chetan.com"},
//3
    {student: "Aayush Diyali", portLink: "Aayush Diyali.com"},
    {student: "Ngoc Nhu An Do", portLink: "Ngoc Nhu.com"},
    {student: "Juliana Paola Gambuzza Bernal", portLink: "Juliana Paola.com"},
    {student: "Tamunotubo Jackreece", portLink: "Tamunotubo.com"},
    {student: "Noah Kennedy", portLink: "Noah Kennedy.com"},
//4
    {student: "Benjamin Kettlewell", portLink: "Benjamin Kettlewell.com"},
    {student: "Mikhail Kirs", portLink: "mikhailkirs.com"},
    {student: "Liam Kuchta", portLink: "liamkuchta.com"},
    {student: "Qihong Liu", portLink: "Qihong Liu.com"},
    {student: "Abigail Londini", portLink: "Abigail Londini.com"},
//5
    {student: "Yi Lu", portLink: "Yi Lu.com"},
    {student: "Zeran Lu", portLink: "Zeran Lu.com"},
    {student: "Rin Morito", portLink: "Rin Morito.com"},
    {student: "Josephine Muncaster", portLink: "Josephine Muncaster.com"},
    {student: "Justine Nathalie Ng", portLink: "Justine Nathalie.com"},
//6
    {student: "Anh Nguyen", portLink: "Anh Nguyen.com"},
    {student: "Linh Nguyen", portLink: "Linh Nguyen.com"},
    {student: "Diya Sanjay Patel", portLink: "Diya Sanjay.com"},
    {student: "Pranav Pranav", portLink: "Pranav Pranav.com"},
    {student: "Situ Ranjit", portLink: "Situ Ranjit.com"},
//7
    {student: "Laila Seif", portLink: "Laila Seif.com"},
    {student: "Hannah Silva", portLink: "Hannah Silva.com"},
    {student: "Daljit Singh", portLink: "Daljit Singh.com"},
    {student: "Roni Soud", portLink: "Roni Soud.com"},
    {student: "Rabin Tamang", portLink: "Rabin Tamang.com"},
//8
    {student: "Kingsley Watson", portLink: "Kingsley Watson.com"},
    {student: "Zakia Sultana", portLink: "Zakia Sultana.com"},
   
];

console.log(portfolios[0].student);
console.log(portfolios[0].portLink);


portfolios.forEach((portfolio) => {
    const portfolioDiv = document.createElement("div");
    portfolioDiv.classList.add("col-span-2", "m-col-span-3");

    const nameOfStudent = document.createElement("h3");
    nameOfStudent.textContent = portfolio.student;

    const portfolioLink = document.createElement("a");
    portfolioLink.href = `http://${portfolio.portLink}`;
    portfolioLink.target = "blank";
    portfolioLink.textContent = portfolio.portLink;

    portfolioDiv.appendChild(nameOfStudent);
    portfolioDiv.appendChild(portfolioLink);

    portfolioSection.appendChild(portfolioDiv);
});