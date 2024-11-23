function toggleSidebar() {
    const sidebar = document.getElementById('sidebar');
    sidebar.classList.toggle('open');  // Toggle the 'open' class to show or hide sidebar
}

function showImage(img) {
    const displayArea = document.getElementById('displayArea');
    displayArea.innerHTML = `<img src="${img.src}" alt="${img.alt}">`;
  }

document.getElementById('sendButton').addEventListener('click', function() {
    alert('Your PDF has been sent successfully!');
});