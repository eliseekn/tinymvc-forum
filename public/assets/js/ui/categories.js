document.addEventListener('DOMContentLoaded', () => {
    //add category form display
    if (document.querySelector('#add-category')) {
        document.querySelector('#add-category').addEventListener('click', event => {
            event.preventDefault()

            if (document.querySelector('#add-category-form').classList.contains('d-none')) {
                document.querySelector('#add-category-form').classList.remove('d-none')
                document.querySelector('#add-category-form').scrollIntoView(false)
            } else {
                document.querySelector('#add-category-form').classList.add('d-none')
            }
        })
    }

    //set up category data for edition
    if (document.querySelectorAll('.edit-category')) {
        document.querySelectorAll('.edit-category').forEach(element => {
            element.addEventListener('click', event => {
                event.preventDefault()

                document.querySelector('#edit-category-form').setAttribute('action', webRoot + 'category/update/' + event.target.dataset.categoryId)
                document.querySelector('#edit-category-form #name').value = event.target.dataset.categoryName
                document.querySelector('#edit-category-form #description').innerHTML = event.target.dataset.categoryDescription

                $('#category-modal').modal('show')
            })
        })
    }

    //send edit category post request
    if (document.querySelector('#edit-category-form')) {
        document.querySelector('#edit-category-form').addEventListener('submit', event => {
            event.preventDefault()

            const action = document.querySelector('#edit-category-form').getAttribute('action');

            postRequest(action, new FormData(event.target)).then(() => {
                window.location.reload()
            })
        })
    }
})