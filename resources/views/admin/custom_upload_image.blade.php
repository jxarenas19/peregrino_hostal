
<script src="{{ cbAsset('js/jquery/dist/jquery.min.js') }}"></script>
<div class="form-group">
    <div class="row">
        <div class="col-sm-5">
            <div class="input-group">
                <input type="hidden" name="icon" class="form-control" readonly >
                <span class="input-group-btn">
                    <button class="btn btn-default" onclick="showModal(this)" type="button">Seleccionar</button>
                </span>
                <div id="upload_preview_flags" style="margin-bottom: 10px" >
                </div>
            </div><!-- /input-group -->
        </div>
    </div>
</div>

<div class="modal fade" id="modal-imageflags">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Elegir</h4>
            </div>
            <div class="modal-body">

                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="heading-flags">
                            <h4 class="panel-title">
                                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#flags" aria-expanded="true">
                                    Listado
                                </a>
                            </h4>
                        </div>
                        <div id="flags" class="panel-collapse collapse" role="tabpanel" >
                            <div class="panel-body">
                                <div class="row">
                                    @foreach($icons as $icon)
                                        <div class="col-sm-2">
                                            <a href="javascript:;" onclick="selectIcon(this)" data-icon="{{ $icon }}">
                                                <img src="{{asset($icon)}}" width="50" height="50" />
                                            <!-- <div class="font-wrap">
                                                    <i class="{{ $icon }}"></i> <br/>{{ explode(".",explode("/",$icon)[3])[0] }}
                                                </div>-->
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<script>
    $( document ).ready(function() {
        var option  =<?php echo json_encode(cb()->getCurrentMethod()); ?>;
        if(option== "getEdit")  {
            var flags = $('.img-thumbnail')[0].currentSrc;
            $("#upload_preview_flags").html("<a href='"+flags+"' data-lightbox='preview-image' title='"+flags+"'>" +
                "<img width='70' height='70' class='img-thumbnail' style='max-width:250px' src='"+flags+"' title='Vista Previa'/></a>");
            $('#form-group-icon')[0].hidden = true;
        }

    });




    function showModal(t) {
        $('#modal-imageflags').modal('show');
    }

    function selectIcon(t) {
        let icon = $(t).data("icon");
        $("input[name=icon]").val(icon);
        $("#modal-imageflags").modal("hide");
        $("#upload_preview_flags").html("<a href='{{asset("")}}"+icon+"' data-lightbox='preview-image' title='{{asset("")}}"+icon+"'>" +
            "<img width='70' height='70' class='img-thumbnail' style='max-width:250px' src='{{asset("")}}"+icon+"' title='Vista Previa'/></a>");
    }
</script>