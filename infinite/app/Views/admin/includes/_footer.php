</section>
</div>
<footer class="main-footer">
    <div class="pull-right hidden-xs">
        <strong style="font-weight: 600;"><?= $settings->copyright; ?>&nbsp;</strong>
    </div>
    <b>Version</b> 4.2
</footer>
</div>
<script src="<?= base_url('assets/admin/js/jquery-ui.min.js'); ?>"></script>
<script>
    //update token
    $("form").submit(function () {
        $("input[name='" + InfConfig.csrfTokenName + "']").val(getCsrfHash());
    });
    //get csrf hash
    function getCsrfHash() {
        var name = InfConfig.csrfCookieName + "=";
        var decodedCookie = decodeURIComponent(document.cookie);
        var ca = decodedCookie.split(';');
        for (var i = 0; i < ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) == ' ') {
                c = c.substring(1);
            }
            if (c.indexOf(name) == 0) {
                return c.substring(name.length, c.length);
            }
        }
        return "";
    }
    //add csrf token
    function addCsrf(data) {
        data[InfConfig.csrfTokenName] = getCsrfHash();
        data['sysLangId'] = InfConfig.sysLangId;
    }
</script>
<!-- Bootstrap 3.3.7 -->
<script src="<?= base_url('assets/vendor/bootstrap/js/bootstrap.min.js'); ?>"></script>
<!-- AdminLTE App -->
<script src="<?= base_url('assets/admin/js/adminlte.min.js'); ?>"></script>
<!-- DataTables js -->
<script src="<?= base_url('assets/admin/plugins/datatables/jquery.dataTables.min.js'); ?>"></script>
<script src="<?= base_url('assets/admin/plugins/datatables/dataTables.bootstrap.min.js'); ?>"></script>
<!-- Lazy Load js -->
<script src="<?= base_url('assets/admin/js/lazysizes.min.js'); ?>"></script>
<!-- iCheck js -->
<script src="<?= base_url('assets/vendor/icheck/icheck.min.js'); ?>"></script>
<!-- Pace -->
<script src="<?= base_url('assets/admin/plugins/pace/pace.min.js'); ?>"></script>
<!-- File Manager -->
<script src="<?= base_url('assets/admin/plugins/file-manager/file-manager-1.2.js'); ?>"></script>
<script src="<?= base_url('assets/admin/plugins/tagsinput/jquery.tagsinput.min.js'); ?>"></script>
<!-- Bootstrap Toggle js -->
<script src="<?= base_url('assets/admin/js/bootstrap-toggle.min.js'); ?>"></script>
<!-- Plugins js -->
<script src="<?= base_url('assets/admin/js/plugins.js'); ?>"></script>
<!-- Datepicker js -->
<script src="<?= base_url('assets/vendor/bootstrap-datetimepicker/moment.min.js'); ?>"></script>
<script src="<?= base_url('assets/vendor/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js'); ?>"></script>

<script src="<?= base_url('assets/admin/plugins/colorpicker/bootstrap-colorpicker.min.js'); ?>"></script>
<!-- Custom js -->
<script src="<?= base_url('assets/admin/js/custom-4.2.js'); ?>"></script>

<?php if (isset($langSearchColumn)): ?>
    <script>
        var table = $('#cs_datatable_lang').DataTable({
            dom: 'l<"#table_dropdown">frtip',
            "order": [[0, "desc"]],
            "aLengthMenu": [[15, 30, 60, 100], [15, 30, 60, 100, "All"]]
        });
        //insert a label
        $('<label class="table-label"><label/>').text('Language').appendTo('#table_dropdown');

        //insert the select and some options
        $select = $('<select class="form-control input-sm"><select/>').appendTo('#table_dropdown');

        $('<option/>').val('').text('<?= trans("all"); ?>').appendTo($select);
        <?php foreach ($languages as $lang): ?>
        $('<option/>').val('<?= $lang->name; ?>').text('<?= $lang->name; ?>').appendTo($select);
        <?php endforeach; ?>


        $("#table_dropdown select").change(function () {
            table.column(<?= $langSearchColumn; ?>).search($(this).val()).draw();
        });
    </script>
<?php endif; ?>

<script src="<?= base_url('assets/admin/plugins/tinymce/jquery.tinymce.min.js'); ?>"></script>
<script src="<?= base_url('assets/admin/plugins/tinymce/tinymce.min.js'); ?>"></script>
<script>
    tinymce.init({
        selector: '.tinyMCE',
        min_height: 500,
        valid_elements: '*[*]',
        relative_urls: false,
        remove_script_host: false,
        directionality: directionality,
        language: '<?= $activeLang->text_editor_lang; ?>',
        menubar: 'file edit view insert format tools table help',
        plugins: [
            "advlist autolink lists link image charmap print preview anchor",
            "searchreplace visualblocks code codesample fullscreen",
            "insertdatetime media table paste imagetools"
        ],
        toolbar: 'code preview | undo redo | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | image media link | fullscreen',
        content_css: ['<?= base_url("assets/admin/plugins/tinymce/editor_content.css"); ?>'],
    });
    tinymce.DOM.loadCSS('<?= base_url("assets/admin/plugins/tinymce/editor_ui.css"); ?>');
</script>

</body>
</html>
