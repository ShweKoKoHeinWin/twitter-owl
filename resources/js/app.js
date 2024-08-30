import './bootstrap';

let imgInputField = document.querySelector('.img-input-field')
let startImgIdx = 0;

window.createRepeatable = function(event) {
    let repeatableContainer = document.querySelector('.repeatable-container');
    let repeatableElement = document.querySelector('.repeatable-element');
    let newRepeatableElement = repeatableElement.cloneNode(true);
    repeatableContainer.append(newRepeatableElement);
}

window.createImage = function(event) {
    event.preventDefault();
    let imgField = document.createElement('div');
    let imgInput = document.createElement('input');
    imgInput.setAttribute('type', 'file');
    imgInput.accept = 'image/*';
    imgInput.multiple = false;
    imgInput.setAttribute('name', `images[${startImgIdx}]`);
    imgInput.className = 'd-none img-inputs';
    imgField.appendChild(imgInput);
    imgInputField.appendChild(imgField);

    startImgIdx++; //add new image will add index of image

    imgInput.click();
    imgInput.addEventListener('change', function() {
        let previewImgbox = document.createElement('div');
        previewImgbox.className = "mb-1 preview-img-box border";
        let delbtn = document.createElement('i');
        delbtn.className = 'fa fa-trash btn btn-danger border del-img-btn';
        let previewImg = document.createElement('img');
        previewImg.src = URL.createObjectURL(this.files[0]);
        previewImg.className = 'w-100'
        previewImgbox.appendChild(previewImg);
        previewImgbox.appendChild(delbtn);
        imgField.appendChild(previewImgbox);
    })
    imgInput.oncancel = function() {
        if (imgInput.files.length == 0) {

            startImgIdx--; //cancel add new image will substract index of image

            imgField.remove();
        }
    }
}

window.checkAllBox = function(name, check = true) {
    let checkboxes = document.querySelectorAll(`input[name="${name}"]`);
    checkboxes.forEach(box => {
        box.checked = check;
    });
}

window.previewImg = function () {
    let preview = document.querySelector('.preview_img');
    let image = document.querySelector('#image');

    image.addEventListener('change', function() {
        preview.src = URL.createObjectURL(this.files[0]);
    })
}

document.addEventListener('click', function(event) {
    if (event.target.classList.contains('del-img-btn')) {
        let imgfield = event.target.parentElement.parentElement;
        if (imgfield.classList.contains('server-imgs')) {
            let imgId = imgfield.getAttribute('data-id');
            let deletedImgIdxInput = document.querySelector(`.del-img-input-${imgId}`);
            deletedImgIdxInput.checked = true;
        }
        imgfield.remove();
    }

    if (event.target.classList.contains('remove-btn')) {
        let element = event.target;
        let removeAbleElement = element.closest('.removeable-element');

        removeAbleElement.remove();
    }
})


