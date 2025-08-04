<!-- Flash Message Container -->
<div id="flash-message-container" style="position: fixed; top: 80px; right: 20px; z-index: 9999; width: 350px;">
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('success') ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('error') ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>
</div>

<script>
    window.addEventListener('DOMContentLoaded', function () {
        setTimeout(() => {
            const container = document.getElementById('flash-message-container');
            if (container) {
                container.remove();
            }
        }, 2000);
    });
</script>
