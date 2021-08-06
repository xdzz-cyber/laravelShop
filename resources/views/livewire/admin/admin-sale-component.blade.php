<div>
    <div class="container py-3 px-0">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Sale settings
                    </div>
                    <div class="panel-body">
                        @if(Session::has("success_message"))
                            <div class="alert alert-success" role="alert">
                                {{Session::get("success_message")}}
                            </div>
                        @endif
                        <form method="post" class="form-horizontal" wire:submit.prevent="updateSale">

                            <div class="form-group">
                                <label for="status" class="col-md-4 control-label">
                                    Status
                                </label>
                                <div class="col-md-4">
                                    <select class="form-control" name="status" id="status" wire:model="status">
                                        <option value="0">Inactive</option>
                                        <option value="1">Active</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="sale_date" class="col-md-4 control-label">
                                    Sale date
                                </label>
                                <div class="col-md-4">
                                    <input type="text" id="sale_date" placeholder="YYYY/MM/DD H:M:S"
                                           class="form-control input-md" wire:model="sale_date">
                                </div>
                            </div>

                            <div class="form-group text-center">
                                <div class="col-md-12">
                                    <input type="submit" class="btn btn-primary" value="Update">
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push("scripts")
    <script>
        $(() => {
            $("#sale_date").datetimepicker({
                format: "Y-MM-DD h:m:s",
            }).on("dp.change", function (e) {
                let data = $("#sale_date").val();
            @this.set("sale_date", data)
            })
        });
    </script>
@endpush
