document.addEventListener('DOMContentLoaded', () => {
    if (document.querySelector('#register-form')) {
        document.querySelector('#register-form').addEventListener('submit', event => {
            event.preventDefault()

            /* let formData = new FormData()
            formData.append('name', document.querySelector('#name').value)
            formData.append('gender', document.querySelector("input[name='gender']").value)
            formData.append('department', document.querySelector('#department').value)
            formData.append('grade', document.querySelector('#grade').value)
            formData.append('email', document.querySelector('#email').value)
            formData.append('password', document.querySelector('#password').value) */
    
            postRequest(webRoot + 'register', new FormData(event.target)).then(response => {
                if (response === undefined || response === null) {
                    new MessageBox().display(
                        'Inscription validée', 
                        'Votre inscription au forum a été validée. Vous pouvez maintenant vous connecter.',
                        webRoot + 'connexion'
                    )
                } else {
                    new MessageBox().display(
                        "Echec de l'inscription", 
                        'Cette adresse email est déjà utilisée par un autre utilisateur.'
                    )
                }
            })
        })
    }

    if (document.querySelectorAll('.remove-user')) {
        document.querySelectorAll('.remove-user').forEach(element => {
            element.addEventListener('click', event => {
                event.preventDefault()

                if (window.confirm('Etes-vous sûr de vouloir supprimer cet utilisateur?')) {
                    postRequest(webRoot + 'admin/delete_user/' + event.target.dataset.userId).then(response => {
                        
                        if (response === undefined || response === null) {
                            new MessageBox().display(
                                'Utilisateur supprimé avec succès', 
                                "L'utilisateur a été retiré de la base de données avec succès",
                                webRoot + 'tableau-de-bord/utilisateurs'
                            )
                        } else {
                            new MessageBox().display(
                                "Echec lors de la suppression de l'utilisateur", 
                                "L'utilisateur sélectionné n'a pas pû être retiré de la base de données."
                            )
                        }
                    });
                }
            })
        })
    }
})