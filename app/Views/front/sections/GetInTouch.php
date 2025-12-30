<section id="contact" class="py-5 contact-section bg-white">
    <div class="container">
        <h2 class="section-title">Get In Touch</h2>
        <div class="row">
            <div class="col-lg-6 mb-4" id="contact-form-section">
                <h4 class="mb-4">Send us a Message</h4>
                <div id="form-messages" class="mb-3"></div>
                    <form id="ajax-contact-form" method="POST">
                        <?= csrf_field() ?>

                        <div class="mb-3">
                            <input type="text" id="name" name="name" class="form-control green-input" placeholder="Your Name*" required>
                            <div class="invalid-feedback">Please enter your name.</div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 mb-2 mb-md-0">
                                <input type="email" id="email" name="email" class="form-control green-input" placeholder="Your Email*">
                            </div>
                            <div class="col-md-6 form-group mb-3">
                                <label for="phone_number" hidden>Phone Number</label>
                                <input type="tel" name="phone_number" id="phone_number"
                                    class="form-control green-input <?= isset($errors['phone_number']) ? 'is-invalid' : '' ?>" 
                                    value="<?= old('phone_number') ?>"
                                    pattern="[0-9]{10}" maxlength="10" title="Please enter a 10-digit phone number" placeholder="Your Phone Number*">
                                <?php if (isset($errors['phone_number'])) : ?>
                                    <div class="invalid-feedback d-block"><?= esc($errors['phone_number']) ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="mb-3">
                            <input type="text" id="enquiry" name="subject" class="form-control green-input" placeholder="Subject*" required>
                            <div class="invalid-feedback">Please enter a subject.</div>
                        </div>

                        <div class="mb-3">
                            <select name="waste_categories[]" id="waste_categories" class="form-control green-input selectpicker" data-live-search="true" title="Select Waste*" style="color: #6c757d;">
                                <option>Select Waste*</option>
                                <option value="Other">Other</option>
                                <?php foreach ($waste_types as $waste): ?>
                                    <option value="<?= esc($waste['name']) ?>"><?= esc($waste['name']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>                        

                        <div class="mb-3">
                            <textarea name="message" id="message" class="form-control green-input" rows="5" placeholder="Your Message*" required></textarea>
                        </div>

                        <div class="alert alert-danger hide" style="display: none;" role="alert" id="error_msg"></div>
                        <div class="alert alert-success hide" style="display: none;" role="alert" id="success_msg"></div>

                        <button type="button" onclick="submit_detail()" class="btn btn-success">Send Message</button>
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

<script type="text/javascript">
    $(document).ready(function() {
        // Prevent non-numeric characters in phone field
        $('#phone_number').on('keypress', function(e) {
            // Allow only digits (0-9)
            if (e.which < 48 || e.which > 57) {
                e.preventDefault();
            }
        });

        // Also handle paste events for phone field
        $('#phone_number').on('paste', function(e) {
            var pastedData = e.originalEvent.clipboardData.getData('text');
            if (!/^\d+$/.test(pastedData)) {
                e.preventDefault();
            }
        });

        // Remove any non-numeric on input (backup for mobile keyboards)
        $('#phone_number').on('input', function() {
            this.value = this.value.replace(/[^0-9]/g, '');
        });

        // Real-time validation functions
        function showError(field, message) {
            field.addClass('is-invalid').removeClass('is-valid');
            var feedback = field.next('.invalid-feedback');
            if (feedback.length === 0) {
                field.after('<div class="invalid-feedback">' + message + '</div>');
            } else {
                feedback.text(message);
            }
        }

        function showSuccess(field) {
            field.removeClass('is-invalid').addClass('is-valid');
        }

        function validateEmail(email) {
            var regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return regex.test(email);
        }

        // Real-time validation on blur
        $('#name').on('blur', function() {
            var value = $(this).val().trim();
            if (value === '') {
                showError($(this), 'Please enter your name.');
            } else if (value.length < 2) {
                showError($(this), 'Name must be at least 2 characters.');
            } else {
                showSuccess($(this));
            }
        });

        $('#email').on('blur', function() {
            var value = $(this).val().trim();
            if (value === '') {
                showError($(this), 'Please enter your email.');
            } else if (!validateEmail(value)) {
                showError($(this), 'Please enter a valid email address.');
            } else {
                showSuccess($(this));
            }
        });

        $('#phone_number').on('blur', function() {
            var value = $(this).val().trim();
            if (value === '') {
                showError($(this), 'Please enter your phone number.');
            } else if (value.length !== 10) {
                showError($(this), 'Phone number must be 10 digits.');
            } else {
                showSuccess($(this));
            }
        });

        $('#enquiry').on('blur', function() {
            var value = $(this).val().trim();
            if (value === '') {
                showError($(this), 'Please enter a subject.');
            } else {
                showSuccess($(this));
            }
        });

        $('#message').on('blur', function() {
            var value = $(this).val().trim();
            if (value === '') {
                showError($(this), 'Please enter your message.');
            } else if (value.length < 10) {
                showError($(this), 'Message must be at least 10 characters.');
            } else {
                showSuccess($(this));
            }
        });

        // Clear validation on focus
        $('#name, #email, #phone_number, #enquiry, #message').on('focus', function() {
            $(this).removeClass('is-invalid is-valid');
        });
    });

    function submit_detail() {
        $('#success_msg').html('').hide();
        $('#error_msg').html('').hide();

        // Get values
        let name = $('#name').val().trim();
        let email = $('#email').val().trim();
        let phone = $('#phone_number').val().trim();
        let enquiry = $('#enquiry').val().trim();
        let message = $('#message').val().trim();

        // Validation
        let isValid = true;
        let errors = [];

        // Name validation
        if (name === '') {
            $('#name').addClass('is-invalid');
            errors.push('Name is required.');
            isValid = false;
        } else if (name.length < 2) {
            $('#name').addClass('is-invalid');
            errors.push('Name must be at least 2 characters.');
            isValid = false;
        }

        // Email validation
        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (email === '') {
            $('#email').addClass('is-invalid');
            errors.push('Email is required.');
            isValid = false;
        } else if (!emailRegex.test(email)) {
            $('#email').addClass('is-invalid');
            errors.push('Please enter a valid email address.');
            isValid = false;
        }

        // Phone validation
        if (phone === '') {
            $('#phone_number').addClass('is-invalid');
            errors.push('Phone number is required.');
            isValid = false;
        } else if (phone.length !== 10) {
            $('#phone_number').addClass('is-invalid');
            errors.push('Phone number must be 10 digits.');
            isValid = false;
        }

        // Subject validation
        if (enquiry === '') {
            $('#enquiry').addClass('is-invalid');
            errors.push('Subject is required.');
            isValid = false;
        }

        // Message validation
        if (message === '') {
            $('#message').addClass('is-invalid');
            errors.push('Message is required.');
            isValid = false;
        } else if (message.length < 10) {
            $('#message').addClass('is-invalid');
            errors.push('Message must be at least 10 characters.');
            isValid = false;
        }

        // If validation fails, show errors
        if (!isValid) {
            $('#error_msg').html(errors.join('<br>')).show();
            return false;
        }

        // Submit via AJAX
        let form = $('#ajax-contact-form')[0];
        let formData = new FormData(form);

        $.ajax({
            url: "<?= base_url('sendMessage') ?>",
            type: "POST",
            data: formData,
            dataType: 'json',
            contentType: false,
            processData: false,
            beforeSend: function() {
                $('button[onclick="submit_detail()"]').prop('disabled', true).text('Sending...');
            },
            success: function (response) {
                $('button[onclick="submit_detail()"]').prop('disabled', false).text('Send Message');
                if (response.status === 'success') {
                    $("#ajax-contact-form")[0].reset();
                    $('.is-valid').removeClass('is-valid');
                    $('#success_msg').html(response.message).show();
                    setTimeout(() => { $('#success_msg').fadeOut(); }, 5000);
                } else {
                    $('#error_msg').html(response.message).show();
                    setTimeout(() => { $('#error_msg').fadeOut(); }, 5000);
                }
            },
            error: function () {
                $('button[onclick="submit_detail()"]').prop('disabled', false).text('Send Message');
                $('#error_msg').html('Something went wrong. Please try again.').show();
            }
        });
    }
</script>