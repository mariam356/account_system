{{-- start model show  Message--}}
<div id="ModalShowCategory" class="modal fade text-left" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="card-content">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="margin:7px;padding-top: 10px">&times;</span>
                </button>
                <div class="form-details card-body ">
                    <div class="align-items-center">
                        <div class=" btn-round position-absolute round" style="font-size: 20px;"
                             id="show_status"></div>
                        <center>
                            <a target='_blank' href="{{$video->links ?? ''}}">  <img src="https://img.youtube.com/vi/{{ substr($video->links ?? '', 32) }}/default.jpg" alt="YouTube Video Thumbnail"></a>
                        </center>
                    </div>
                    <hr>
                    <div class="row p-1">
                        <div class="col-sm-12">
                            <h2 class="name product-title" style=" color: #fbb615"></h2>
                            <span class="details price" style="color: #002581"></span>

                            <hr>
                        </div>
                        <div class="col-sm-9">
                            <small class="price category-color">{{__('admin.created_at')}}:</small>
                            <small class="price category-color created"></small>
                            <br>
                            <small class="price category-color">{{__('admin.updated_at')}}:</small>
                            <small class="price category-color updated_at"></small>
                        </div>
                        <div class="col-sm-3 text-center">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- end model show  Message--}}
