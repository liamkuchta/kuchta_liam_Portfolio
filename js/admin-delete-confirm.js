const deleteLinks = document.querySelectorAll('.delete-btn');

function handleDeleteClick(event) {
  const confirmed = window.confirm('Are you sure?');

  if (!confirmed) {
    event.preventDefault();
  }
}

function attachDeleteHandler(link) {
  link.addEventListener('click', handleDeleteClick);
}

deleteLinks.forEach(attachDeleteHandler);
