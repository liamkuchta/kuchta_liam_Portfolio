

export function initContactForm() {
    console.log('initContactForm called');
    const form = document.querySelector('form');
    const sendBtn = document.querySelector('#send-btn');
    
    if (!form) {
        console.log('contact form not found');
        return;
    }
    console.log('contact form found, attaching listener');
    async function handleFormSubmit(e) {
        e.preventDefault();

        const name = document.querySelector('#name_input').value.trim();
        const email = document.querySelector('#email_input').value.trim();
        const message = document.querySelector('#message_input').value.trim();

        sendBtn.disabled = true;
        sendBtn.textContent = 'Sending...';

        const formData = new FormData();
        formData.append('name', name);
        formData.append('email', email);
        formData.append('message', message);

        try {
            const response = await fetch('includes/send.php', {
                method: 'POST',
                body: formData
            });

            const data = await response.json();

            if (response.ok && data.success) {
                showSuccessMessage(data.message);
                form.reset();
                sendBtn.textContent = 'Send';
                sendBtn.disabled = false;
            } else {
                let errorMessage = 'An error occurred. Please try again.';

                if (data.errors && data.errors.length > 0) {
                    errorMessage = data.errors.join(', ');
                } else if (data.message) {
                    errorMessage = data.message;
                }

                showErrorMessage(errorMessage);
                sendBtn.textContent = 'Send';
                sendBtn.disabled = false;
            }
        } catch (error) {
            console.error('Contact form error:', error);
            showErrorMessage('Network error. Please try again later.');
            sendBtn.textContent = 'Send';
            sendBtn.disabled = false;
        }
    }

    form.addEventListener('submit', handleFormSubmit);
}


//  Displays success message to user
 
 
function showSuccessMessage(message) {
    removeMessages();

    const messageDiv = document.createElement('div');
    messageDiv.className = 'form-message form-success';
    messageDiv.textContent = message;
    messageDiv.setAttribute('role', 'alert');

    const form = document.querySelector('form');
    form.parentNode.insertBefore(messageDiv, form.nextSibling);

    function removeSuccessMessage() {
        messageDiv.remove();
    }

    setTimeout(removeSuccessMessage, 5000);
}


//   error message to user

function showErrorMessage(message) {
    removeMessages();

    const messageDiv = document.createElement('div');
    messageDiv.className = 'form-message form-error';
    messageDiv.textContent = message;
    messageDiv.setAttribute('role', 'alert');

    const form = document.querySelector('form');
    form.parentNode.insertBefore(messageDiv, form.nextSibling);

    function removeErrorMessage() {
        messageDiv.remove();
    }

    setTimeout(removeErrorMessage, 5000);
}


//  Removes existing form messages
 
function removeMessages() {
    const existingMessages = document.querySelectorAll('.form-message');

    function removeMessageNode(msg) {
        msg.remove();
    }

    existingMessages.forEach(removeMessageNode);
}
