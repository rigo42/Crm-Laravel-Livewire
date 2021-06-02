
@if (Session::has('alert'))
@section('footer')
<script>
    swal.fire({
        position: 'top-end',
        icon: "{!! Session::get('alert-type') !!}",
        title: "{!! Session::get('alert') !!}",
        showConfirmButton: false,
        timer: 1500
    });
</script>
@endsection
@endif
    <!--begin::Card-->
    <div class="card card-custom card-sticky" id="kt_page_sticky_card">
        <div class="card-header">
            <div class="card-title">
                <h3 class="card-label">Nuevo cliente</h3>
            </div>
            <div class="card-toolbar">
                <button 
                    wire:click="store"
                    wire:loading.class="spinner spinner-white spinner-right" 
                    wire:target="store" 
                    class="btn btn-primary font-weight-bolder mr-2">
                    <i class="fa fa-save"></i>
                    Guardar cambios
                </button>
            </div>
        </div>
        <div class="card-body">
            <!--begin::Form-->
            <form class="form" id="kt_form">
                <div class="row">
                    <div class="col-xl-2"></div>
                    <div class="col-xl-8">
                        <div class="my-5">
                            <h3 class="text-dark font-weight-bold mb-10">Customer Info:</h3>
                            <div class="form-group row">
                                <label class="col-xl-3 col-lg-3 col-form-label">Avatar</label>
                                <div class="col-lg-9 col-xl-9">
                                    <div class="image-input image-input-outline" >
                                        <div class="image-input-wrapper" style="background-image: url('https://scontent.fgdl5-4.fna.fbcdn.net/v/t1.6435-9/118951466_3246824028698411_6934573790732331002_n.jpg?_nc_cat=101&ccb=1-3&_nc_sid=09cbfe&_nc_eui2=AeFRHgEl-xmrDwqfp62lS22KXeK_GUaA3Rdd4r8ZRoDdFxZQ1nftJFf3KqyPgHRRZpb1RkexfXh2-qt_tAHUwGW9&_nc_ohc=mXUzIKpn070AX977BjS&_nc_ht=scontent.fgdl5-4.fna&oh=991d5e3e5273fcee2cbaf2cb30442a94&oe=60DCDE23')"></div>
                                        <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow image-edit" >
                                            <i class="fa fa-pen icon-sm text-muted"></i>
                                            <input type="file" name="profile_avatar" accept=".png, .jpg, .jpeg" class="d-none"/>
                                        </label>
                                        <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow image-remove"  title="Cancel avatar">
                                            <i class="ki ki-bold-close icon-xs text-muted"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-3">First Name</label>
                                <div class="col-9">
                                    <input class="form-control form-control-solid" type="text" value="Nick" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-3">Last Name</label>
                                <div class="col-9">
                                    <input class="form-control form-control-solid" type="text" value="Watson" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-3">Company Name</label>
                                <div class="col-9">
                                    <input class="form-control form-control-solid" type="text" value="Loop Inc." />
                                    <span class="form-text text-muted">If you want your invoices addressed to a company. Leave blank to use your full name.</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-3">Contact Phone</label>
                                <div class="col-9">
                                    <div class="input-group input-group-solid">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="la la-phone"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control form-control-solid" value="+45678967456" placeholder="Phone" />
                                    </div>
                                    <span class="form-text text-muted">We'll never share your email with anyone else.</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-3">Email Address</label>
                                <div class="col-9">
                                    <div class="input-group input-group-solid">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="la la-at"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control form-control-solid" value="nick.watson@loop.com" placeholder="Email" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-3">Company Site</label>
                                <div class="col-9">
                                    <div class="input-group input-group-solid">
                                        <input type="text" class="form-control form-control-solid" placeholder="Username" value="loop" />
                                        <div class="input-group-append">
                                            <span class="input-group-text">.com</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="my-5">
                            <h3 class="text-dark font-weight-bold mb-10">Customer Info:</h3>
                            <div class="form-group row">
                                <label class="col-xl-3 col-lg-3 col-form-label">Avatar</label>
                                <div class="col-lg-9 col-xl-9">
                                    <div class="image-input image-input-outline" >
                                        <div class="image-input-wrapper" style="background-image: url('https://scontent.fgdl5-4.fna.fbcdn.net/v/t1.6435-9/118951466_3246824028698411_6934573790732331002_n.jpg?_nc_cat=101&ccb=1-3&_nc_sid=09cbfe&_nc_eui2=AeFRHgEl-xmrDwqfp62lS22KXeK_GUaA3Rdd4r8ZRoDdFxZQ1nftJFf3KqyPgHRRZpb1RkexfXh2-qt_tAHUwGW9&_nc_ohc=mXUzIKpn070AX977BjS&_nc_ht=scontent.fgdl5-4.fna&oh=991d5e3e5273fcee2cbaf2cb30442a94&oe=60DCDE23')"></div>
                                        <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow image-edit" >
                                            <i class="fa fa-pen icon-sm text-muted"></i>
                                            <input type="file" name="profile_avatar" accept=".png, .jpg, .jpeg" class="d-none"/>
                                        </label>
                                        <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow image-remove"  title="Cancel avatar">
                                            <i class="ki ki-bold-close icon-xs text-muted"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-3">First Name</label>
                                <div class="col-9">
                                    <input class="form-control form-control-solid" type="text" value="Nick" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-3">Last Name</label>
                                <div class="col-9">
                                    <input class="form-control form-control-solid" type="text" value="Watson" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-3">Company Name</label>
                                <div class="col-9">
                                    <input class="form-control form-control-solid" type="text" value="Loop Inc." />
                                    <span class="form-text text-muted">If you want your invoices addressed to a company. Leave blank to use your full name.</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-3">Contact Phone</label>
                                <div class="col-9">
                                    <div class="input-group input-group-solid">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="la la-phone"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control form-control-solid" value="+45678967456" placeholder="Phone" />
                                    </div>
                                    <span class="form-text text-muted">We'll never share your email with anyone else.</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-3">Email Address</label>
                                <div class="col-9">
                                    <div class="input-group input-group-solid">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="la la-at"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control form-control-solid" value="nick.watson@loop.com" placeholder="Email" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-3">Company Site</label>
                                <div class="col-9">
                                    <div class="input-group input-group-solid">
                                        <input type="text" class="form-control form-control-solid" placeholder="Username" value="loop" />
                                        <div class="input-group-append">
                                            <span class="input-group-text">.com</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2"></div>
                </div>
            </form>
            <!--end::Form-->
        </div>
    </div>
    <!--end::Card-->
    