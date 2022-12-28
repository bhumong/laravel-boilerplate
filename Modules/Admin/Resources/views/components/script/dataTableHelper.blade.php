<script type="module">
    function filterDataTable($dataTable, filter) {
        $dataTable.columns().every(function() {
            var name = this.dataSrc();
            this.search(filter[name] || '');
        });
        $dataTable.draw();
    }
    window.filterDataTable = filterDataTable;
</script>
