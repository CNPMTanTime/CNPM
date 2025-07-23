</div>

<!-- Jquery js -->
<script src="../../template/admin/js/jquery-3.7.1.min.js"></script>
<!-- Bootstrap Bundle Js -->
<script src="../../template/admin/js/boostrap.bundle.min.js"></script>
<!-- Phosphor Js -->
<script src="../../template/admin/js/phosphor-icon.js"></script>
<!-- file upload -->
<script src="../../template/admin/js/file-upload.js"></script>
<!-- file upload -->
<script src="../../template/admin/js/plyr.js"></script>
<!-- dataTables -->
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
<!-- full calendar -->
<script src="../../template/admin/js/full-calendar.js"></script>
<!-- jQuery UI -->
<script src="../../template/admin/js/jquery-ui.js"></script>
<!-- jQuery UI -->
<script src="../../template/admin/js/editor-quill.js"></script>
<!-- apex charts -->
<script src="../../template/admin/js/apexcharts.min.js"></script>
<!-- Calendar Js -->
<script src="../../template/admin/js/calendar.js"></script>
<!-- jvectormap Js -->
<script src="../../template/admin/js/jquery-jvectormap-2.0.5.min.js"></script>
<!-- jvectormap world Js -->
<script src="../../template/admin/js/jquery-jvectormap-world-mill-en.js"></script>
<!-- Trumbowyg -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.19.1/trumbowyg.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.19.1/plugins/table/trumbowyg.table.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.19.1/plugins/upload/trumbowyg.upload.min.js"></script>
<script>
$('#editor').trumbowyg({
    btnsDef: {
        image: {
            dropdown: ['insertImage', 'upload'],
            ico: 'insertImage'
        }
    },
    btns: [
        ['viewHTML'],
        ['formatting'],
        ['strong', 'em', 'del'],
        ['link'],
        ['image'],
        ['unorderedList', 'orderedList'],
        ['table'],
        ['fullscreen']
    ],
    plugins: {
        table: {
            rows: 5,
            columns: 5,
            allowHorizontalResize: true
        },
        upload: {
            serverPath: 'upload.php',
            fileFieldName: 'fileToUpload',
            statusPropertyName: 'success',
            urlPropertyName: 'file'
        }
    }
});
</script>
<script>
function removeRow(id) {
    if (confirm('Bạn có chắc chắn muốn xoá không?')) {
        window.location = '?del-id=' + id;
    }
}
</script>
<!-- main js -->
<script src="../../template/admin/js/main.js"></script>
</body>

</html>
