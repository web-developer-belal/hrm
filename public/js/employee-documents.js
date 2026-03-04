// Accordion functionality
function toggleAccordion(element) {
    const button = element.querySelector('.expand-btn');
    const icon = button.querySelector('i');
    const accordionBody = document.getElementById('empDocument');

    // Toggle icon rotation
    icon.classList.toggle('rotate-180');

    // Toggle accordion body
    accordionBody.classList.toggle('hidden');
}

// Download all documents function
function downloadAllDocuments() {
    const documents = document.querySelectorAll('#empDocument a[href]');
    if (documents.length === 0) {
        alert('No documents available to download.');
        return;
    }

    documents.forEach((doc, index) => {
        setTimeout(() => {
            window.open(doc.href, '_blank');
        }, index * 500); // Open each document with 500ms delay
    });
}

// Upload document function
function uploadDocument() {
    // You can implement this based on your requirements
    // For now, it could trigger a Livewire event
    if (typeof Livewire !== 'undefined') {
        Livewire.dispatch('openDocumentUpload');
    } else {
        alert('Document upload functionality will be implemented here.');
    }
}

// Add CSS for rotate animation
const style = document.createElement('style');
style.textContent = `
    .rotate-180 {
        transform: rotate(180deg);
    }
    .hidden {
        display: none;
    }
`;
document.head.appendChild(style);

// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    // Close all accordions initially except maybe the first one
    const accordionBodies = document.querySelectorAll('.accordion-body');
    accordionBodies.forEach(body => {
        if (!body.closest('#empDocument')) {
            body.classList.add('hidden');
        }
    });
});
