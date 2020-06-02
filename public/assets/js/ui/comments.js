document.addEventListener('DOMContentLoaded', () => {
    //add comment form display
    if (document.querySelector('#add-comment')) {
        document.querySelector('#add-comment').addEventListener('click', event => {
            event.preventDefault()

            if (document.querySelector('#add-comment-form').classList.contains('d-none')) {
                document.querySelector('#add-comment-form').classList.remove('d-none')
                document.querySelector('#add-comment-form').scrollIntoView(false)
            } else {
                document.querySelector('#add-comment-form').classList.add('d-none')
            }
        })
    }

    //set up comment data for edition
    if (document.querySelectorAll('.edit-comment')) {
        document.querySelectorAll('.edit-comment').forEach(element => {
            element.addEventListener('click', event => {
                event.preventDefault()

                document.querySelector('#edit-comment-form').setAttribute('action', webRoot + 'comment/update/' + event.target.dataset.commentId)
                document.querySelector('#edit-comment-form #content').innerHTML = event.target.dataset.commentContent

                $('#comment-modal').modal('show')
            })
        })
    }

    //send edit comment post request
    if (document.querySelector('#edit-comment-form')) {
        document.querySelector('#edit-comment-form').addEventListener('submit', event => {
            event.preventDefault()

            const action = document.querySelector('#edit-comment-form').getAttribute('action');

            postRequest(action, new FormData(event.target)).then(() => {
                window.location.reload()
            })
        })
    }

    //delete comment
    if (document.querySelectorAll('.delete-comment')) {
        document.querySelectorAll('.delete-comment').forEach(element => {
            element.addEventListener('click', event => {
                event.preventDefault()

                if (window.confirm('Etes-vous sûr de vouloir supprimer ce message?')) {
                    window.location.href = webRoot + 'comment/delete/' + event.target.dataset.commentId
                }
            })
        })
    }
})