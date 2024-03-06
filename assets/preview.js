const mediaPrototype = document.querySelector('#trick_form_medias');
const collectionHolder = document.querySelector('.addMedia');
document.querySelector('.add_item_media').addEventListener('click', () => {
    const item = document.createElement('div');
    item.innerHTML = mediaPrototype
        .dataset
        .prototype
        .replace(
            /__name__/g,
            collectionHolder.dataset.index
        );
    item.addEventListener('change', function (event) {
        let reader = new FileReader();
        reader.onload = function () {
            let outputImage = document.getElementById('imagePreview');
            let outputVideo = document.getElementById('videoPreview');
            if (/png|jpeg|jpg/.test(event.target.files[0].name)) {
                outputImage.src = reader.result;
                outputImage.style.display = 'block';
                outputVideo.style.display = 'none'
                return;
            }
            outputVideo.src = reader.result;
            outputVideo.style.display = 'block';
            outputImage.style.display = 'none'
        }
        console.log('event.target.files[0]:', event.target.files[0]);
        reader.readAsDataURL(event.target.files[0]);
    });
    collectionHolder.appendChild(item);

    collectionHolder.dataset.index++;
})
