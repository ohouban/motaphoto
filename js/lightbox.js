document.addEventListener("DOMContentLoaded", function () {
    const lightboxDiv = document.createElement('div');
    lightboxDiv.classList.add('lightbox-overlay');
    lightboxDiv.innerHTML = `
        <img class="lightbox-image" src="" alt="Image en plein écran">
        <div class="lightbox-content">
            <p class="lightbox-reference"></p>
            <p class="lightbox-category"></p>
        </div>

        <div class="arrow next"></div>
        <div class="arrow prev"></div>
        <div class="close"></div>
    `;
    document.body.appendChild(lightboxDiv);

    let currentImageIndex = 0;
    let totalImages;
    let images;

    function adjustLightboxContentWidth() {
        const lightboxImg = lightboxDiv.querySelector('.lightbox-image');
        const lightboxContent = lightboxDiv.querySelector('.lightbox-content');
        lightboxContent.style.width = lightboxImg.width + 'px';
    }

    function openLightbox() {
        images = document.querySelectorAll('.overlay-image');

        const currentImage = images[currentImageIndex];
        if (!currentImage) {
            console.error('Image courante non trouvée');
            return;
        }
        const imageUrl  = currentImage.querySelector('figure img').getAttribute('src');
        console.log(totalImages);
        console.log(imageUrl);
        const category = currentImage.querySelector('.right_now').textContent;
        const reference = currentImage.querySelector('.reference').textContent;
        
        console.log(category);
        console.log(reference);
        const lightboxImg = lightboxDiv.querySelector('.lightbox-image');
        const lightboxContent = lightboxDiv.querySelector('.lightbox-content');


        lightboxImg.onload = adjustLightboxContentWidth;

        lightboxDiv.querySelector('.lightbox-image').setAttribute('src', imageUrl);
        lightboxDiv.querySelector('.lightbox-category').textContent = category;
        lightboxDiv.querySelector('.lightbox-reference').textContent = reference;

        window.addEventListener('resize', adjustLightboxContentWidth);

        lightboxDiv.style.display = 'block';
    }

    function initLightbox() {
        images = document.querySelectorAll('.overlay-image');
        totalImages = images.length;
    }

    document.addEventListener('click', function (e) {
        if (e.target.matches('.full_screen')) {
            initLightbox();
            currentImageIndex = Array.from(images).indexOf(e.target.closest('.overlay-image'));
            openLightbox();
        }
    });

    initLightbox();  // Initialisation après le chargement


    const closeBtn = document.querySelector('.close')
    closeBtn.addEventListener('click', () => {
        window.addEventListener('resize', adjustLightboxContentWidth);
        lightboxDiv.style.display = "none";
    });

    const arrows = lightboxDiv.querySelectorAll('.arrow');
    arrows.forEach(arrow => {
        arrow.addEventListener('click', () => {
            if (arrow.classList.contains('next')) {
                currentImageIndex++;
                if (currentImageIndex >= totalImages) {
                    currentImageIndex = 0;
                }
            } else {
                currentImageIndex--;
                if (currentImageIndex < 0) {
                    currentImageIndex = totalImages - 1;
                }
            }
            openLightbox();
        });
    });
});