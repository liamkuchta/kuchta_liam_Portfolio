

export function initContactForm() {
    console.log('initContactForm called');
    const form = document.querySelector('form');
    const sendBtn = document.getElementById('send-btn');
    
    if (!form) {
        console.log('contact form not found');
        return;
    }
    console.log('contact form found, attaching listener');
    
    
    //   handles form submission
    // prevents default behavior and sends ajax request
      
   
    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        
        // Get form values
        const name = document.getElementById('name_input').value.trim();
        const email = document.getElementById('email_input').value.trim();
        const message = document.getElementById('message_input').value.trim();
        
        // Disable button during submission
        sendBtn.disabled = true;
        sendBtn.textContent = 'Sending...';
        
        // Prepare form data
        const formData = new FormData();
        formData.append('name', name);
        formData.append('email', email);
        formData.append('message', message);
        
        try {
            // Send AJAX request to send.php
            const response = await fetch('includes/send.php', {
                method: 'POST',
                body: formData
            });
            
            const data = await response.json();
            
            // Handle response
            if (response.ok && data.success) {
                // Success
                showSuccessMessage(data.message);
                form.reset();
                sendBtn.textContent = 'Send';
                sendBtn.disabled = false;
            } else {
                // Error
                const errorMessage = data.errors && data.errors.length > 0 
                    ? data.errors.join(', ') 
                    : data.message || 'An error occurred. Please try again.';
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
    });
}


//  Displays success message to user
 
 
function showSuccessMessage(message) {
    // Remove existing messages
    removeMessages();
    
    // Create success message element
    const messageDiv = document.createElement('div');
    messageDiv.className = 'form-message form-success';
    messageDiv.textContent = message;
    messageDiv.setAttribute('role', 'alert');
    
    // Insert after form
    const form = document.querySelector('form');
    form.parentNode.insertBefore(messageDiv, form.nextSibling);
    
    // Auto-remove after 5 seconds
    setTimeout(() => {
        messageDiv.remove();
    }, 5000);
}


//   error message to user

function showErrorMessage(message) {
    // remove existing messages
    removeMessages();
    
    // create error message 
    const messageDiv = document.createElement('div');
    messageDiv.className = 'form-message form-error';
    messageDiv.textContent = message;
    messageDiv.setAttribute('role', 'alert');
    
    // insert after form
    const form = document.querySelector('form');
    form.parentNode.insertBefore(messageDiv, form.nextSibling);
    
    // auto remove after 5 seconds
    setTimeout(() => {
        messageDiv.remove();
    }, 5000);
}


//  Removes existing form messages
 
function removeMessages() {
    const existingMessages = document.querySelectorAll('.form-message');
    existingMessages.forEach(msg => msg.remove());
}
