import './bootstrap';

window.addEventListener('pageshow', (event) => {
    if (event.persisted) {
        window.location.reload();
    }
});

const searchInput = document.querySelector('#q');
const clearSearchButton = document.querySelector('#clear-search');
const postCards = [...document.querySelectorAll('[data-post-search]')];
const liveSearchEmptyState = document.querySelector('#live-search-empty');

if (searchInput && postCards.length > 0) {
    const filterPosts = () => {
        const searchTerm = searchInput.value.trim().toLowerCase();
        let visiblePosts = 0;

        postCards.forEach((postCard) => {
            const matches = postCard.dataset.postSearch.includes(searchTerm);
            postCard.hidden = !matches;
            visiblePosts += matches ? 1 : 0;
        });

        if (liveSearchEmptyState) {
            liveSearchEmptyState.hidden = visiblePosts > 0;
        }

        if (clearSearchButton) {
            clearSearchButton.hidden = searchTerm.length === 0;
        }
    };

    searchInput.addEventListener('input', filterPosts);

    clearSearchButton?.addEventListener('click', () => {
        searchInput.value = '';
        searchInput.focus();
        filterPosts();
    });

    filterPosts();
}
