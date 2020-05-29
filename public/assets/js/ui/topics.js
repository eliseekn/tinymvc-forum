document.addEventListener('DOMContentLoaded', () => {
    if (document.querySelector('#topic-form')) {
        document.querySelector('#topic-form').addEventListener('submit', event => {
            event.preventDefault()

            let formData = new FormData()
            formData.append('title', document.querySelector('#title').value)
            formData.append('content', document.querySelector('#content').value)

            if (event.target.dataset.submitAction === 'add') {
                const attachments = document.querySelector('#attachments').files
                
                for (let i = 0; i < attachments.length; i++) {
                    let attachment = attachments[i]
                    formData.append('attachments[]', attachment)
                }

                postRequest(webRoot + 'administration/nouveau-sujet', formData).then(response => {
                    if (response === undefined || response === null) {
                        new MessageBox().display(
                            'Sujet de discussion créé avec succès', 
                            `Le sujet "${document.querySelector('#title').value}" a été créé avec succès`,
                            webRoot + 'forum/nouveau-sujet'
                        )
                    } else {
                        new MessageBox().display(
                            'Erreur lors de la création du sujet', 
                            `Une erreur est survenue lors de la création du sujet 
                            "${document.querySelector('#title').value}". Veuillez réessayer SVP.`
                        )
                    } 
                })
            } else {
                postRequest(webRoot + 'administration/modifier-sujet/' + event.target.dataset.topicId, formData)
                    .then(response => {
                        if (response === undefined || response === null) {
                            new MessageBox().display(
                                'Sujet modifié avec succès', 
                                `Le sujet "${document.querySelector('#title').value}" a été modifié avec succès`
                            )
                        } else {
                            new MessageBox().display(
                                'Erreur lors de la modification du sujet', 
                                `Une erreur est survenue lors de la modification du sujet 
                                "${document.querySelector('#title').value}". Veuillez réessayer SVP.`
                            )
                        } 
                })
            }
        })
    }

    if (document.querySelectorAll('.remove-topic')) {
        document.querySelectorAll('.remove-topic').forEach(element => {
            element.addEventListener('click', event => {
                event.preventDefault()

                if (window.confirm('Etes-vous sûr de vouloir supprimer ce sujet de discussion?')) {
                    postRequest(webRoot + 'admin/delete_topic/' + event.target.dataset.topicId).then(response => {
                        
                        if (response === undefined || response === null) {
                            new MessageBox().display(
                                'Sujet supprimé avec succès', 
                                'Le sujet de discussion a été retiré de la base de données avec succès',
                                webRoot + 'tableau-de-bord/sujets-de-discussion'
                            )
                        } else {
                            new MessageBox().display(
                                'Echec lors de la suppression du sujet de discussion', 
                                "Le sujet de discussion sélectionné n'a pas pû être retiré de la base de données."
                            )
                        }
                    });
                }
            })
        })
    }
})