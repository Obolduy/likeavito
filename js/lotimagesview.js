let i = 0;

let images = document.getElementsByClassName('image');
let image__minor = document.getElementsByClassName('image__minor');

images[0].style.display = 'block';
image__minor[0].style.border = 'solid #3789db'

function nextImg() {
    if (i + 1 < images.length) {
        image__minor[i].style.border = 'none'

        images[i++].style.display = 'none'
        images[i].style.display = 'block'

        image__minor[i].style.border = 'solid #3789db'
    }
}

function prevImg() { 
    if (i < images.length && i > 0) {
        image__minor[i].style.border = 'none'

        images[i--].style.display = 'none'
        images[i].style.display = 'block'

        image__minor[i].style.border = 'solid #3789db'
    }
}

function takeImg(number) {
    for (let count = 0; count < image__minor.length; count++) {
        image__minor[count].style.border = 'none'

        images[count].style.display = 'none'

        if (count == number) {
            images[number].style.display = 'block'

            image__minor[number].style.border = 'solid #3789db'

            i = number;
        }
    }
}

for (elem of images) {
    elem.addEventListener('click', (event) => {  
        if (event.layerX >= event.target.width / 2) {
            nextImg()
        } else {
            prevImg()
        }
    });
}

for (elem of image__minor) {
    elem.addEventListener('click', (event) => {
        divelem = event.target.parentElement

        for (let number = 0; number < divelem.parentElement.children.length; number++) {
            if (divelem.parentElement.children[number] == divelem) {
                takeImg(number)
            }
        }
    });
}