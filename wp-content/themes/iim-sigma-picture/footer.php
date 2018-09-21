<footer class="">
    <!-- your code HTML footer here -->Footer
</footer>

<!-- Scripts -->
<?php wp_footer(); ?>
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/file-uploader/5.16.2/jquery.fine-uploader/jquery.fine-uploader.min.js"></script>
<?php $version = filemtime( get_theme_root() . '/' . get_template() . '/script/build/main.js' ); ?>
<script src="<?php bloginfo( 'template_directory' ); ?>/script/build/main.js?v=<?= $version; ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

<script type="text/template" id="qq-template-manual-trigger">
    <div class="qq-uploader-selector qq-uploader" qq-drop-area-text="Glisser des fichiers ici">
        <div class="qq-total-progress-bar-container-selector qq-total-progress-bar-container">
            <div role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" class="qq-total-progress-bar-selector qq-progress-bar qq-total-progress-bar"></div>
        </div>
        <div class="qq-upload-drop-area-selector qq-upload-drop-area" qq-hide-dropzone>
            <span class="qq-upload-drop-area-text-selector"></span>
        </div>
        <div class="buttons">
            <div class="qq-upload-button-selector qq-upload-button">
                <div>Sélectionner des fichiers</div>
            </div>
            <button type="button" id="trigger-upload" class="btn btn-primary">
                <i class="icon-upload icon-white"></i> Upload
            </button>
        </div>
        <span class="qq-drop-processing-selector qq-drop-processing">
                <span>Chargement...</span>
                <span class="qq-drop-processing-spinner-selector qq-drop-processing-spinner"></span>
            </span>
        <ul class="qq-upload-list-selector qq-upload-list" aria-live="polite" aria-relevant="additions removals">
            <li>
                <div class="qq-progress-bar-container-selector">
                    <div role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" class="qq-progress-bar-selector qq-progress-bar"></div>
                </div>
                <span class="qq-upload-spinner-selector qq-upload-spinner"></span>
                <img class="qq-thumbnail-selector" qq-max-size="100" qq-server-scale>
                <span class="qq-upload-file-selector qq-upload-file"></span>
                <span class="qq-edit-filename-icon-selector qq-edit-filename-icon" aria-label="Edit filename"></span>
                <input class="qq-edit-filename-selector qq-edit-filename" tabindex="0" type="text">
                <span class="qq-upload-size-selector qq-upload-size"></span>
                <button type="button" class="qq-btn qq-upload-cancel-selector qq-upload-cancel">Annuler</button>
                <button type="button" class="qq-btn qq-upload-retry-selector qq-upload-retry">Réessayer</button>
                <button type="button" class="qq-btn qq-upload-delete-selector qq-upload-delete">Supprimer</button>
                <span role="status" class="qq-upload-status-text-selector qq-upload-status-text"></span>
            </li>
        </ul>

        <dialog class="qq-alert-dialog-selector">
            <div class="qq-dialog-message-selector"></div>
            <div class="qq-dialog-buttons">
                <button type="button" class="qq-cancel-button-selector">Fermer</button>
            </div>
        </dialog>

        <dialog class="qq-confirm-dialog-selector">
            <div class="qq-dialog-message-selector"></div>
            <div class="qq-dialog-buttons">
                <button type="button" class="qq-cancel-button-selector">Non</button>
                <button type="button" class="qq-ok-button-selector">Oui</button>
            </div>
        </dialog>

        <dialog class="qq-prompt-dialog-selector">
            <div class="qq-dialog-message-selector"></div>
            <input type="text">
            <div class="qq-dialog-buttons">
                <button type="button" class="qq-cancel-button-selector">Annuler</button>
                <button type="button" class="qq-ok-button-selector">Ok</button>
            </div>
        </dialog>
    </div>
</script>

<?php if ( is_page( get_page_by_path( 'dashboard' ) ) ): ?>
    <script>
        $(document).ready(function () {
            $('#fine-uploader-manual-trigger').fineUploader({
                template: 'qq-template-manual-trigger',
                debug: true,
                request: {
                    endpoint: '<?php echo bloginfo( 'url' ); ?>/wp-content/themes/iim-sigma-picture/function/front/endpoint.php'
                },
                thumbnails: {
                    placeholders: {
                        waitingPath: '<?php echo bloginfo( 'url' ); ?>/wp-content/uploader/waiting-generic.png',
                        notAvailablePath: '<?php echo bloginfo( 'url' ); ?>/wp-content/uploader/not_available-generic.png'
                    }
                },
                autoUpload: false,
                validation: {
                    allowedExtensions: ['jpeg', 'jpg', 'png', 'mov', 'mp4', 'raw'],
                    itemLimit: 3,
                    sizeLimit: 500000 * 1024, // 50 kB = 50 * 1024 bytes
                    allowEmpty: true
                },
                callbacks: {
                    onProgress: function () {
                        $('#qq-form .btn-upload').attr('disabled', 'disabled');
                    },
                    onAllComplete: function () {
                        $('#qq-form input[type="email"]').attr('disabled', 'disabled');
                        $('#qq-form .btn-upload').attr('value', 'Ajouter de nouveaux fichiers').removeAttr('disabled');
                        $('#qq-form').append('<a href="">Créer un nouveau compte</a>');
                    }
                }
            });
        });
    </script>
<?php endif; ?>
<!--
<?php if ( is_page( get_page_by_path( 'upload-to-user' ) ) ): ?>
    <script>
        $(document).ready(function () {
            $('#fine-uploader-manual-trigger').fineUploader({
                template: 'qq-template-manual-trigger',
                debug: true,
                request: {
                    endpoint: '<?php echo bloginfo( 'url' ); ?>/wp-content/themes/iim-sigma-picture/function/front/endpoint.php'
                },
                thumbnails: {
                    placeholders: {
                        waitingPath: '<?php echo bloginfo( 'url' ); ?>/wp-content/uploader/waiting-generic.png',
                        notAvailablePath: '<?php echo bloginfo( 'url' ); ?>/wp-content/uploader/not_available-generic.png'
                    }
                },
                autoUpload: false,
                validation: {
                    allowedExtensions: ['jpeg', 'jpg', 'png', 'mov', 'mp4', 'raw'],
                    itemLimit: 3,
                    sizeLimit: 500000 * 1024, // 50 kB = 50 * 1024 bytes
                    allowEmpty: true
                },
                callbacks: {
                    onProgress: function () {
                        $('#qq-form .btn-upload').attr('disabled', 'disabled');
                        $('#qq-form select').attr('disabled', 'disabled');
                    },
                    onAllComplete: function () {
                        $('#qq-form .btn-upload').removeAttr('disabled');
                        $('#qq-form').append('<a href="">Envoyer à un autre utilisateur</a>');
                    }
                }
            });
        });

        $(document).on('click', '.btn-upload', function () {
            $('#qq-form').find('input[type="email"]').attr('disabled', 'disabled');
        });
    </script>
<?php endif; ?>
-->
</body>
</html>
