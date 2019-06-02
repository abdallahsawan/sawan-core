<!-- Modal -->
<div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="delete-modal-label">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="delete-modal-label">Delete</h4>
            </div>
            <div class="modal-body">
                <form id="delete-form" method="post">
                    <div class="alert-div"></div>
                    {{csrf_field()}}
                    {{method_field('delete')}}
                    <input type="hidden" name="id" id="delete-modal-id">
                </form>
                <h3 id="delete-modal-message"></h3>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" form="delete-form" class="btn btn-danger">Delete
                </button>
            </div>
        </div>
    </div>
</div>

@push('js')
    <script>
        $('.btn-delete').on('click', function () {
            var id = $(this).data('id');
            var modal = $(this).data('modal');
            var action = "{{url('/')}}";

            if (modal === "news")
                action += '/' + modal + '/' + id;
            else
                action += '/' + modal + 's/' + id;

            $("#delete-form").attr('action', action);
            $.get('get/' + modal + '/' + id).done(function (response) {
                $('#delete-modal-id').val(response.id);
                var message = "<span><i>Are your sure you want to delete the " + modal + " : " + response.name + " ?</i></span>";
                $('#delete-modal-message').html(message);
            });
        });
    </script>
@endpush