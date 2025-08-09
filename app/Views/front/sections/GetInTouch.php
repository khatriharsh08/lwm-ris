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
                            <div class="col-md-6">
                                <input type="text" inputmode="numeric" pattern="[0-9]*" id="mobile" name="mobile" class="form-control green-input" placeholder="Your Number*">
                            </div>
                        </div>

                        <div class="mb-3">
                            <input type="text" id="enquiry" name="subject" class="form-control green-input" placeholder="Subject*" required>
                            <div class="invalid-feedback">Please enter a subject.</div>
                        </div>

                        <div class="mb-3">
                            <select name="waste_categories[]" id="waste_categories" class="form-control green-input selectpicker" data-live-search="true" title="Select Waste*" style="color: #6c757d;">
                                <option>Select Waste*</option>
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
    function submit_detail() {
        $('#sucess_msg').html('').hide();
        $('#error_msg').html('').hide();

        // Basic validation
        let name = $('#name').val().trim();
        let email = $('#email').val().trim();
        let enquiry = $('#enquiry').val().trim();
        let mobile = $('#mobile').val().trim();

        if (name === '' || email === '' || mobile === '' || enquiry === '') {
            $('#error_msg').html('Please fill in all required fields.').css('color', 'red').show();
            return false;
        }

        let form = $('#ajax-contact-form')[0];
        let formData = new FormData(form);

        $.ajax({
            url: "<?= base_url('sendMessage') ?>",
            type: "POST",
            data: formData,
            async: false,
            dataType: 'json',
            contentType: false,
            processData: false,
            success: function (response) {
                if (response.status === 'success') {
                    $("#ajax-contact-form")[0].reset();
                    $('#sucess_msg').html(response.message).css('color', 'green').show();
                    setTimeout(() => { $('#sucess_msg').fadeOut(); }, 3000);
                } else {
                    $('#error_msg').html(response.message).css('color', 'red').show();
                    setTimeout(() => { $('#error_msg').fadeOut(); }, 3000);
                }
            },
            error: function () {
                $('#error_msg').html('Something went wrong. Please try again.').css('color', 'red').show();
            }
        });
    }

</script>