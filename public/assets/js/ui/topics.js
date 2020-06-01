document.addEventListener('DOMContentLoaded', () => {
    if (document.querySelectorAll('.delete-topic')) {
        document.querySelectorAll('.delete-topic').forEach(element => {
            element.addEventListener('click', event => {
                event.preventDefault()

                if (window.confirm('Etes-vous sûr de vouloir supprimer ce sujet de discussion? Tous les messages associés seront aussi supprimé? Voulez vous continuez?')) {
                    window.location.href = webRoot + 'topic/delete/' + event.target.dataset.topicId
                }
            })
        })
    }
})