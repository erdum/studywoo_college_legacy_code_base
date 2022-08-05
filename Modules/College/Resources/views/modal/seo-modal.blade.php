
<div id="seo-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" >
    <div class="modal-dialog modal-right">
        <div class="modal-content">
            <div class="modal-header border-0">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div>
                    <h5 class="text-uppercase mt-0 mb-3 bg-light p-2">Add Meta Data</h5>
                    <form method="post" data-url="/seo">
                        @csrf
                        <input type="hidden" name="id">
                        <input type="hidden" id="parent_type_id" name="parent_type_id">
                        <div class="form-group mb-3">
                            <label for="product-meta-title">Meta title</label>
                            <input type="text" class="form-control" name="meta_title" id="product-meta-title" placeholder="Enter meta title">
                        </div>

                        <div class="form-group mb-3">
                            <label for="product-meta-keywords">Meta Keywords</label>
                            <input type="text" class="form-control" name="meta_keyword" id="product-meta-keywords" placeholder="Enter keywords">
                        </div>

                        <div class="form-group mb-0">
                            <label for="product-meta-description">Meta Description </label>
                            <textarea class="form-control" rows="5" name="meta_description" id="product-meta-description" placeholder="Please enter meta description"></textarea>
                        </div>
                        <div class="col">
                            <div class="float-right">
                                <button type="submit" class="btn btn-success  mt-3">Submit</button>
                            </div>
                        </div>

                    </form>

                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
