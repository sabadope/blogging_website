// Header Toggle

let MenuBtn = document.getElementById('MenuBtn')
let ResMenu = document.getElementById('ResMenu')

MenuBtn.addEventListener('click', ()=>{
    MenuBtn.classList.toggle('fa-xmark')
    ResMenu.classList.toggle('open-menu')
})


// ==== About Button Tab START ====//

// You can do same things by using other method .... but this is simple one that's why i choose this. its easy to //

// About Button Tab

//get all Buttons
let Btn1 = document.getElementById('Btn1')
let Btn2 = document.getElementById('Btn2')
let Btn3 = document.getElementById('Btn3')

// get all blocks
let Btn1Filter = document.getElementById('Btn1Filter')
let Btn2Filter = document.getElementById('Btn2Filter')
let Btn3Filter = document.getElementById('Btn3Filter')

//logic
Btn1.addEventListener('click', ()=>{
    Btn1.classList.add('active-btn')
    Btn2.classList.remove('active-btn')
    Btn3.classList.remove('active-btn')

    Btn1Filter.style.display = 'block'
    Btn1Filter.style.opacity = '1'

    Btn2Filter.style.display = 'none'
    Btn2Filter.style.opacity = '0'

    Btn3Filter.style.display = 'none'
    Btn3Filter.style.opacity = '0'
})

Btn2.addEventListener('click', ()=>{
    Btn1.classList.remove('active-btn')
    Btn2.classList.add('active-btn')
    Btn3.classList.remove('active-btn')

    Btn1Filter.style.display = 'none'
    Btn1Filter.style.opacity = '0'

    Btn2Filter.style.display = 'block'
    Btn2Filter.style.opacity = '1'

    Btn3Filter.style.display = 'none'
    Btn3Filter.style.opacity = '0'
})

Btn3.addEventListener('click', ()=>{
    Btn1.classList.remove('active-btn')
    Btn2.classList.remove('active-btn')
    Btn3.classList.add('active-btn')

    Btn1Filter.style.display = 'none'
    Btn1Filter.style.opacity = '0'

    Btn2Filter.style.display = 'none'
    Btn2Filter.style.opacity = '0'

    Btn3Filter.style.display = 'block'
    Btn3Filter.style.opacity = '1'
})

// ====== About Button Tab End ======//

// ====== Active Link State On Scroll START ==== //

// Get All Links
let navLinks = document.querySelectorAll('header nav ul li a')
// Get All Sections
let section = document.querySelectorAll('section')

window.addEventListener('scroll', function (){
    const scrollPos = window.scrollY + 65
    section.forEach(section => {
        if(scrollPos > section.offsetTop && scrollPos < (section.offsetTop + section.offsetHeight)){
            navLinks. forEach(link => {
                link.classList.remove('active')
                if(section.getAttribute('id') === link.getAttributes('href').substring(1)){
                    link.classList.add('active')
                }
           })
        }
    })
})

// ====== Active Link State On Scroll START ==== //

