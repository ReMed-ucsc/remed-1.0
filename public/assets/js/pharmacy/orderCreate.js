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


// const statusItem = document.querySelector('.chat-box li > a');
//   const parentLi = statusItem.parentElement;

//   statusItem.addEventListener('click', (e) => {
//     e.preventDefault(); // Prevent default link action
//     parentLi.classList.toggle('active'); // Toggle active class
//   });

