const navSlide = () => {
    const burger = document.querySelector('.burger');
    const nav = document.querySelector('.nav-links');
    const navLinks = document.querySelectorAll('.nav-links li');
    

    burger.addEventListener('click',()=>{
        //toggle nav
        nav.classList.toggle('nav-active');
        //Animate links
        navLinks.forEach((link, index) =>{

            if(link.style.animation){
                    link.style.animation = '';
            } else {
                    link.style.animation = `navLinkFade 0.5s ease forwards ${index / 7 + 0.2}s`;
            }

            //console.log(index);
            
            //Delay das letras a aparecer
            //link.style.animation = `navLinkFade 0.5s ease forwards ${index / 7 + 1.3}s`;
            
            //console.log(index / 7); Delay entre cenas a aparecer de lado

            //Para começar com delay
            //console.log(index / 7 + 0.2);
        });

        //Burger Animation
        burger.classList.toggle('toggle');
    });

    
}

navSlide();


// SE TIVER MTAS FUNCOES
// const app = () =>{
//     navSlide();
// }