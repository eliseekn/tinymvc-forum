class MessageBox {
    constructor() { }

    display(title, message, redirect) {
        const htmlElement = document.createElement('div')
        htmlElement.classList.add('modal', 'fade')
        htmlElement.id = 'message-box'
        htmlElement.setAttribute('tabindex', '-1')
        htmlElement.setAttribute('role', 'dialog')
        htmlElement.setAttribute('aria-hidden', 'true')
        htmlElement.innerHTML = `
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">${title}</h5>
                    </div>

                    <div class="modal-body">${message}</div>

                    <div class="modal-footer">
                        <button class="btn btn-primary" data-dismiss="modal">OK</button>
                    </div>
                </div>
            </div>
        `

        document.body.appendChild(htmlElement)

        $('#message-box').modal('show')

        document.querySelector('.modal-footer .btn').addEventListener('click', () => {
            if (redirect) { window.location.href = redirect }
        })
    }
}