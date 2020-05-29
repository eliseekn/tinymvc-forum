document.addEventListener('DOMContentLoaded', () => {
    if (document.querySelector('#add-comment')) {
        document.querySelector('#add-comment').addEventListener('click', event => {
            event.preventDefault()

            document.querySelector('#comment-form').dataset.topicId = event.target.dataset.topicId
            document.querySelector('#comment-form').dataset.userId = event.target.dataset.userId
            
            if (document.querySelector('#add-attachments').classList.contains('d-none')) {
                document.querySelector('#add-attachments').classList.remove('d-none')
            }

			$('#comment-modal').modal('show')
        })
    }

    if (document.querySelectorAll('.edit-comment')) {
        document.querySelectorAll('.edit-comment').forEach(element => {
            element.addEventListener('click', event => {
                event.preventDefault()

                document.querySelector('#comment-form').dataset.commentId = event.target.dataset.commentId
                document.querySelector('.modal-title').innerHTML = 'Modifier le commentaire'
                document.querySelector('#comment').innerHTML = event.target.dataset.commentContent
                document.querySelector("input[type='submit']").value = 'Modifier'
                
                if (!document.querySelector('#add-attachments').classList.contains('d-none')) {
                    document.querySelector('#add-attachments').classList.add('d-none')
                }

                $('#comment-modal').modal('show')
            })
        })
    }

    if (document.querySelector('#comment-form')) {
        document.querySelector('#comment-form').addEventListener('submit', event => {
            event.preventDefault()

            let formData = new FormData()

            if (document.querySelector("input[type='submit']").value === 'Répondre') {
                formData.append('topic_id', event.target.dataset.topicId)
                formData.append('user_id', event.target.dataset.userId)
                formData.append('content', document.querySelector('#comment').value)

                const attachments = document.querySelector('#attachments').files
                
                for (let i = 0; i < attachments.length; i++) {
                    let attachment = attachments[i]
                    formData.append('attachments[]', attachment)
                }

                postRequest(webRoot + 'administration/nouveau-commentaire', formData).then(response => {
                    if (response === undefined || response === null) {
                        postRequest(webRoot + 'admin/inc_comments_count/' + event.target.dataset.topicId).then(() => {
                            window.location.reload()
                        })
                    } else {
                        new MessageBox().display(
                            "Erreur lors de l'ajout de la réponse", 
                            "Une erreur est survenue lors de l'ajout de votre réponse du sujet", 
                            event.target.getAttribute('action')
                        )
                    } 
                })
            } else {
                formData.append('id', event.target.dataset.commentId)
                formData.append('content', document.querySelector('#comment').value)

                postRequest(webRoot + 'administration/modifier-commentaire', formData).then(response => {
                    if (response === undefined || response === null) {
                        window.location.reload()
                    } else {
                        new MessageBox().display(
                            "Erreur lors de l'ajout de la réponse",
                            "Une erreur est survenue lors de l'ajout de votre réponse du sujet",
                            event.target.getAttribute('action')
                        )
                    } 
                })
            }
        })
    }

    if (document.querySelectorAll('.update-comment-score')) {
        document.querySelectorAll('.update-comment-score').forEach(element => {
            element.addEventListener('click', event => {
                event.preventDefault()

                let formData = new FormData()
                formData.append('user_id', event.target.dataset.userId)
                formData.append('comment_id', event.target.dataset.commentId)

                if (event.target.innerHTML === 'Voter') {
                    postRequest(webRoot + 'admin/add_vote', formData).then(() => {
                        postRequest(webRoot + 'admin/inc_comment_score/' + event.target.dataset.commentId).then(() => {
                            window.location.reload()
                        })
                    })
                } else {
                    postRequest(webRoot + 'admin/remove_vote', formData).then(() => {
                        postRequest(webRoot + 'admin/dec_comment_score/' + event.target.dataset.commentId).then(() => {
                            window.location.reload()
                        })
                    })
                }
            })
        })
    }

    if (document.querySelectorAll('.remove-comment')) {
        document.querySelectorAll('.remove-comment').forEach(element => {
            element.addEventListener('click', event => {
                event.preventDefault()

                if (window.confirm('Etes-vous sûr de vouloir supprimer ce message?')) {
                    postRequest(webRoot + 'admin/delete_comment/' + event.target.dataset.commentId).then(response => {
                        
                        if (response === undefined || response === null) {
                            new MessageBox().display(
                                'Message supprimé avec succès', 
                                'Le message a été retiré de la base de données avec succès.',
                                webRoot + 'tableau-de-bord/messages'
                            )
                        } else {
                            new MessageBox().display(
                                'Echec lors de la suppression du message', 
                                "Le message sélectionné n'a pas pû être retiré de la base de données."
                            )
                        }
                    });
                }
            })
        })
    }
})