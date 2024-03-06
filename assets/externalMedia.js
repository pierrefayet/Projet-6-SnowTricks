const externalMediaPrototype = document.querySelector('#trick_form_externalVideo');
const collectionHolder = document.querySelector('.addExternalMedia');
document.querySelector('.add_item__external_media').addEventListener('click', () => {
    const item = document.createElement('li');
    item.innerHTML = externalMediaPrototype
        .dataset
        .prototype
        .replace(
            /__name__/g,
            collectionHolder.dataset.index
        );
    collectionHolder.appendChild(item);

    collectionHolder.dataset.index++;
})