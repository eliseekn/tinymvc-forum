document.addEventListener('DOMContentLoaded', () => {
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