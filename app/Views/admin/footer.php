
            </div> 
             <!-- /.container-fluid -->
 
          </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Local Waste Management & Recycling Information System. <?= date('Y') ?></span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="#">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="<?= base_url('admin/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
    <!-- Custom scripts for all pages-->
    <script src="<?= base_url('admin/assets/js/sb-admin-2.min.js') ?>"></script>

    <!-- Global Number Input Validation -->
    <script>
    $(document).ready(function() {
        // Selector for all number-only input fields (phone, postal code, etc.)
        var numberInputSelector = 'input[name*="phone"], input[name*="postal"], input[name*="pincode"], input[name*="mobile"], input[type="tel"], input[inputmode="numeric"]';
        
        // Prevent non-numeric key presses
        $(document).on('keypress', numberInputSelector, function(e) {
            var charCode = (e.which) ? e.which : e.keyCode;
            // Allow only numbers (0-9)
            if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                e.preventDefault();
                return false;
            }
            return true;
        });
        
        // Clean non-numeric characters on input (handles paste, etc.)
        $(document).on('input', numberInputSelector, function() {
            var cleaned = $(this).val().replace(/[^0-9]/g, '');
            $(this).val(cleaned);
        });
        
        // Handle paste events - clean pasted content
        $(document).on('paste', numberInputSelector, function(e) {
            var $this = $(this);
            setTimeout(function() {
                var cleaned = $this.val().replace(/[^0-9]/g, '');
                $this.val(cleaned);
            }, 10);
        });
    });
    </script>

</body>
</html>