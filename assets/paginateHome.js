document.addEventListener('DOMContentLoaded', () => {
    const loadMoreButton = document.getElementById("load-more");
    if (loadMoreButton) {
        loadMoreButton.addEventListener('click', () => {
            const currentPage = parseInt(loadMoreButton.getAttribute('data-current-page'), 10);
            loadMoreButton.setAttribute('data-current-page', (currentPage + 1).toString());
            const maxPage = parseInt(loadMoreButton.getAttribute('data-max-page'), 10);
            console.log(maxPage);
            fetch(`/get-tricks?page=${currentPage}`, {method: 'GET'})
                .then(response => response.text())
                .then(data => {
                    document.getElementById('portfolio').insertAdjacentHTML('beforeend', data);
                })
            if (currentPage > maxPage) {
                loadMoreButton.parentElement.parentElement.remove();
            }
        });
    }
});