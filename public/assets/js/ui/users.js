document.addEventListener('DOMContentLoaded', () => {
    if (document.querySelectorAll('.delete-user')) {
        document.querySelectorAll('.delete-user').forEach(element => {
            element.addEventListener('click', event => {
                event.preventDefault()

                if (window.confirm('Etes-vous sûr de vouloir supprimer cet utilisateur?')) {
                    window.location.href = webRoot + 'user/delete/' + event.target.dataset.userId
                }
            })
        })
    }
})