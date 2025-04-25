const profilePicInput = document.getElementById('profilePicInput');
const profilePicPreview = document.getElementById('profilePicPreview');

profilePicInput.addEventListener('change', function () {
    const file = this.files[0];
    if (file) {
        profilePicPreview.src = URL.createObjectURL(file);
    }
});
