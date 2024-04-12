document.addEventListener('DOMContentLoaded', function() {
    const editBtns = document.querySelectorAll('.edit-item-btn');

    editBtns.forEach(btn => {
        btn.addEventListener('click', function(event) {
            event.preventDefault(); // Prevent default form submission

            const parentRow = this.closest('tr');
            const addressId = parentRow.dataset.addressId;
            const addressName = parentRow.querySelector('.contactname').textContent.trim();
            const isPublic = parentRow.querySelector('.membership').querySelector('.badge-success') !== null;
            const publicLink = isPublic ? parentRow.querySelector('.address_link').textContent.trim() : '';

            const editModal = document.getElementById('editModal');
            const nameField = editModal.querySelector('#customername-field');
            const membershipField = editModal.querySelector('#membership-field');
            const linkField = editModal.querySelector('#link_id-field');

            nameField.value = addressName;

            if (isPublic) {
                membershipField.value = 'true';
                linkField.value = publicLink;
                linkField.parentElement.style.display = 'block'; // Show the "Public Link" field
            } else {
                membershipField.value = 'false';
                linkField.value = '';
                linkField.parentElement.style.display = 'none'; // Hide the "Public Link" field
            }
        });
    });
});
