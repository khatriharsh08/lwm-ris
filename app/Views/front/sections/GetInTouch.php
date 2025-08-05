<section id="contact" class="py-5 contact-section bg-white">
    <div class="container">
        <h2 class="section-title">Get In Touch</h2>
        <div class="row">
            <div class="col-lg-6 mb-4" id="contact-form-section">
                <h4 class="mb-4">Send us a Message</h4>
                <div id="form-messages" class="mb-3"></div>
                    <form id="ajax-contact-form" action="<?= site_url('home/sendMessage') ?>" method="POST">
                        <?= csrf_field() ?>

                        <div class="mb-3">
                            <input type="text" name="name" class="form-control green-input" placeholder="Your Name" required>
                            <div class="invalid-feedback">Please enter your name.</div>
                        </div>

                        <div class="mb-3">
                            <input type="email" name="email" class="form-control green-input" placeholder="Your Email" required>
                            <div class="invalid-feedback">Please enter a valid email.</div>
                        </div>

                        <div class="mb-3">
                            <input type="text" name="subject" class="form-control green-input" placeholder="Subject" required>
                            <div class="invalid-feedback">Please enter a subject.</div>
                        </div>

                        <div class="mb-3">
                            <div class="dropdown">
                                <button class="btn dropdown-toggle green-input w-100 text-start" type="button" id="dropdownWasteCategories" data-bs-toggle="dropdown" aria-expanded="false" >
                                    Select Categories
                                </button>
                                <ul class="dropdown-menu w-100 px-3 dropdown-menu-scrollable" aria-labelledby="dropdownWasteCategories">
                                    <?php if (!empty($waste_types)): ?>
                                        <?php foreach ($waste_types as $cat): ?>
                                            <li>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="waste_categories[]" value="<?= esc($cat['id']) ?>" id="cat<?= esc($cat['id']) ?>">
                                                    <label class="form-check-label" for="cat<?= esc($cat['id']) ?>">
                                                        <?= esc($cat['name']) ?>
                                                    </label>
                                                </div>
                                            </li>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <li class="px-2 text-muted">No categories available.</li>
                                    <?php endif; ?>
                                </ul>
                            </div>
                            <div class="invalid-feedback">Please select a category.</div>
                        </div>

                        <div class="mb-3">
                            <textarea name="message" class="form-control green-input" rows="5" placeholder="Your Message" required></textarea>
                            <div class="invalid-feedback">Please enter your message.</div>
                        </div>

                        <button type="submit" class="btn btn-success">Send Message</button>
                    </form>
                </div>

                <div class="col-lg-6">
                    <h5 class="fw-bold">Contact Information</h5>
                    <p><i class="fas fa-map-marker-alt me-2 text-success"></i>G. H. Patel PG Dept. of Computer Science & Technology </br>  
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;      Near Jain Derasar, Nana Bazaar  </br>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;      Vallabh Vidyanagar - 388120, Gujarat, India  </p>
                    <p><i class="fas fa-envelope me-2 text-success"></i>contact@lwm-ris.com</p>
                    <p><i class="fas fa-phone me-2 text-success"></i>+91 2692 236829 / +91 2692 230389</p>
                    <p>Feel free to reach out to us for any queries, partnerships, or volunteer opportunities. We're always happy to connect!</p>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('ajax-contact-form');
    if (!form) return;

    const dropdownMenu = form.querySelector('.dropdown-menu');
    const dropdownButton = document.getElementById('dropdownWasteCategories');
    
    if (!dropdownMenu || !dropdownButton) return;

    const checkboxes = dropdownMenu.querySelectorAll('input[type="checkbox"]');

    function updateButtonText() {
        const checkedCount = Array.from(checkboxes).filter(i => i.checked).length;

        if (checkedCount === 0) {
            dropdownButton.textContent = 'Select Categories';
        } else {
            dropdownButton.textContent = `${checkedCount} Categor${checkedCount > 1 ? 'ies' : 'y'} Selected`;
        }
    }

    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', updateButtonText);
    });

    // Prevents the dropdown from closing when clicking inside it
    dropdownMenu.addEventListener('click', function (e) {
        e.stopPropagation();
    });

    // Run on page load in case of pre-filled forms
    updateButtonText();
});
    
document.addEventListener('DOMContentLoaded', function () {
    const contactForm = document.getElementById('ajax-contact-form');
    const messagesDiv = document.getElementById('form-messages');

    if (!contactForm) return;

    contactForm.addEventListener('submit', function (e) {
        e.preventDefault();

        const formData = new FormData(this);
        const url = this.getAttribute('action');
        const submitButton = this.querySelector('button[type="submit"]');

        submitButton.disabled = true;
        submitButton.innerHTML = 'Sending...';

        fetch(url, {
            method: 'POST',
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            messagesDiv.innerHTML = '';

            if (data.status === 'success') {
                const successHtml = `<div class="alert alert-success" role="alert">${data.message}</div>`;
                messagesDiv.innerHTML = successHtml;
                contactForm.reset();

                setTimeout(() => {
                    messagesDiv.innerHTML = '';
                }, 3000);
            } else {
                let errorsHtml = '<div class="alert alert-danger"><ul>';

                if (data.errors) {
                    for (const key in data.errors) {
                        errorsHtml += `<li>${data.errors[key]}</li>`;
                    }
                } else if (data.message) {
                    errorsHtml += `<li>${data.message}</li>`;
                } else {
                    errorsHtml += '<li>An unknown error occurred.</li>';
                }

                errorsHtml += '</ul></div>';
                messagesDiv.innerHTML = errorsHtml;

                setTimeout(() => {
                    messagesDiv.innerHTML = '';
                }, 3000);
            }

        })
        .catch(error => {
            console.error('Error:', error);
            messagesDiv.innerHTML = '<div class="alert alert-danger">An unexpected error occurred. Please try again.</div>';
        })
        .finally(() => {
            submitButton.disabled = false;
            submitButton.innerHTML = 'Send Message';
        });
    });
});

</script>