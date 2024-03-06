document.addEventListener('DOMContentLoaded', () => {
    const loadMoreButton = document.getElementById("load-more");
    const trickId = document.getElementById('trickId').getAttribute('data-trickId');
    if (loadMoreButton) {
        loadMoreButton.addEventListener('click', () => {
            const currentPage = parseInt(loadMoreButton.getAttribute('data-current-page'), 10);
            loadMoreButton.setAttribute('data-current-page', (currentPage + 1).toString());
            const maxPage = parseInt(loadMoreButton.getAttribute('data-max-page'), 10);
            console.log(maxPage);
            fetch(`/get-comments/${trickId}?page=${currentPage}`, { method: 'GET'})
                .then(response => response.text())
                .then(data => {
                    document.querySelector('.content-comment').insertAdjacentHTML('beforeend', data);
                })
            if(currentPage > maxPage) {
                loadMoreButton.parentElement.remove();
            }
        });
    }
});