<script type="module">
    //Initialize Select2 Elements
    $('.select2-role').select2({
        theme: 'bootstrap4',
        ajax: {
            delay: 250,
            url: "{{route('admin/roles/search')}}",
            data: function (params) {
                var query = {
                    search: params.term
                }
                return query;
            }
        },
        processResults: function (data) {
          // Transforms the top-level key of the response object from 'items' to 'results'
          return {
            results: data.items
          };
        }
    })
</script>