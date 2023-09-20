document.addEventListener('DOMContentLoaded', () => {
    
const contactLinks = document.querySelectorAll('.contact-btn');
const overlay = document.querySelector('.popup');
const popup = document.querySelector('.popup-content');
const photoReferenceInput = document.querySelector('#photo-ref');
const postRef = document.querySelector('.reference');


contactLinks.forEach((contactLink) => {
    contactLink.addEventListener('click', () => {
        if (postRef) {
            if(photoReferenceInput){
                photoReferenceInput.value = postRef.textContent.trim()
            }
        }

        overlay.classList.add('open');
    });
});

popup.addEventListener('click', (event) => {
    event.stopPropagation();
});

overlay.addEventListener('click', () => {
    overlay.classList.remove('open');
});

});





document.addEventListener('DOMContentLoaded', () => {
    
    const contactLinks = document.querySelectorAll('.contact-item');
    const overlay = document.querySelector('.popup');
    const popup = document.querySelector('.popup-content');
    const photoReferenceInput = document.querySelector('#photo-ref');
    const postRef = document.querySelector('.reference');
    
    
    contactLinks.forEach((contactLink) => {
        contactLink.addEventListener('click', () => {
            if (postRef) {
                if(photoReferenceInput){
                    photoReferenceInput.value = postRef.textContent.trim()
                }
            }
    
            overlay.classList.add('open');
        });
    });
    
    popup.addEventListener('click', (event) => {
        event.stopPropagation();
    });
    
    overlay.addEventListener('click', () => {
        overlay.classList.remove('open');
    });
    
    });