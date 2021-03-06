document.addEventListener('DOMContentLoaded', () => {
    //search forums topics
    if (document.querySelector('#search-query')) {
        document.querySelector('#search-query').addEventListener('keydown', event => {
            if (event.key === 'Enter') {
                document.querySelector('#navbarNav .input-group-text').click();
            }
        })
    }

    if (document.querySelector('#navbarNav .input-group-text')) {
        document.querySelector('#navbarNav .input-group-text').addEventListener('click', () => {
            const searchQuery = document.querySelector('#search-query').value;

            if (searchQuery !== '') {
                window.location.href = webRoot + 'rechercher?q=' + searchQuery
            }
        })
    }

    //administration items filters
    if (document.querySelector('#categories-filter')) {
        document.querySelector('#categories-filter').addEventListener('keyup', event => {
            const filterText = event.target.value.toUpperCase()

            document.querySelectorAll('.category').forEach(element => {
                if (element.querySelector('.category-name').innerHTML.toUpperCase().indexOf(filterText) > -1 ||
                    element.querySelector('.category-description').innerHTML.toUpperCase().indexOf(filterText) > -1) {
                    element.setAttribute('style', 'display: table-row');
                } else {
                    element.setAttribute('style', 'display: none');
                }
            })
        })
    }

    if (document.querySelector('#topics-filter')) {
        document.querySelector('#topics-filter').addEventListener('keyup', event => {
            const filterText = event.target.value.toUpperCase()

            document.querySelectorAll('.topic').forEach(element => {
                if (element.querySelector('.topic-title').innerHTML.toUpperCase().indexOf(filterText) > -1 ||
                    element.querySelector('.topic-author').innerHTML.toUpperCase().indexOf(filterText) > -1 ||
                    element.querySelector('.topic-date').innerHTML.toUpperCase().indexOf(filterText) > -1 ||
                    element.querySelector('.topic-category').innerHTML.toUpperCase().indexOf(filterText) > -1) {
                    element.setAttribute('style', 'display: table-row');
                } else {
                    element.setAttribute('style', 'display: none');
                }
            })
        })
    }

    if (document.querySelector('#users-filter')) {
        document.querySelector('#users-filter').addEventListener('keyup', event => {
            const filterText = event.target.value.toUpperCase()

            document.querySelectorAll('.user').forEach(element => {
                if (element.querySelector('.user-name').innerHTML.toUpperCase().indexOf(filterText) > -1 ||
                    element.querySelector('.user-email').innerHTML.toUpperCase().indexOf(filterText) > -1 ||
                    element.querySelector('.user-date').innerHTML.toUpperCase().indexOf(filterText) > -1 ||
                    element.querySelector('.user-department').innerHTML.toUpperCase().indexOf(filterText) > -1 ||
                    element.querySelector('.user-grade').innerHTML.toUpperCase().indexOf(filterText) > -1) {
                    element.setAttribute('style', 'display: table-row');
                } else {
                    element.setAttribute('style', 'display: none');
                }
            })
        })
    }

    if (document.querySelector('#comments-filter')) {
        document.querySelector('#comments-filter').addEventListener('keyup', event => {
            const filterText = event.target.value.toUpperCase()

            document.querySelectorAll('.comment').forEach(element => {
                if (element.querySelector('.comment-content').innerHTML.toUpperCase().indexOf(filterText) > -1 ||
                    element.querySelector('.comment-topic').innerHTML.toUpperCase().indexOf(filterText) > -1 ||
                    element.querySelector('.comment-author').innerHTML.toUpperCase().indexOf(filterText) > -1 ||
                    element.querySelector('.comment-date').innerHTML.toUpperCase().indexOf(filterText) > -1) {
                    element.setAttribute('style', 'display: table-row');
                } else {
                    element.setAttribute('style', 'display: none');
                }
            })
        })
    }
})