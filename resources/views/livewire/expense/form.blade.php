<div class="container" x-data="app()">

    @section('head')
        <link rel="stylesheet" href="{{ asset('assets/plugins/custom/bfi/bfi.css') }}">
    @endsection

    <!-- Modal -->
    <div wire:ignore.self class="modal fade" data-backdrop="static" id="categoryExpenseFormModal" tabindex="-1" aria-labelledby="categoryExpenseFormModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="categoryExpenseFormModalLabel">Nueva catagoría de gasto</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                @livewire('setting.category-expense.form', ['method' => 'storeCustom'])
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Regresar</button>
            </div>
        </div>
        </div>
    </div>
    
    <div class="card card-custom card-sticky"  id="kt_page_sticky_card">
        <div class="card-header" wire:ignore>
            <div class="card-title">
                <h3 class="card-label">@yield('title')</h3>
            </div>
            <div class="card-toolbar">
                <button 
                    wire:click="{{ $method }}"
                    wire:loading.class="spinner spinner-white spinner-right" 
                    wire:target="{{ $method }}" 
                    class="btn btn-primary font-weight-bolder mr-2">
                    <i class="fa fa-save"></i>
                    Guardar cambios
                </button>
            </div>
        </div>
        <div class="card-body">
            <!--begin::Form-->
            <form class="form" wire:submit.prevent="{{ $method }}">
                <div class="row">
                    <div class="col-xl-2"></div>
                    <div class="col-xl-8">
                        <div class="my-5">
                            <h3 class="text-dark font-weight-bold mb-10">Información general</h3>

                            @include('component.error-list')

                            <div class="form-group row">
                                <label class="col-xl-3 col-lg-3 col-form-label">Comprobante de gasto </label>
                                <div class="image-input image-input-outline" >
                                    <div 
                                        class="image-input-wrapper"
                                        @if ($imageTmp)
                                            style="background-image: url('{{ $imageTmp->temporaryUrl() }}')"
                                        @elseif($expense->image)
                                            style="background-image: url('{{ Storage::url($expense->image->url) }}')"
                                        @else    
                                            style="background-image: url('{{ asset('assets/media/payment/blank.png') }}')"
                                        @endif
                                        >
                                    </div>
                                    <div
                                        x-data="{ isUploading: false, progress: 0 }"
                                        x-on:livewire-upload-start="isUploading = true"
                                        x-on:livewire-upload-finish="isUploading = false"
                                        x-on:livewire-upload-error="isUploading = false"
                                        x-on:livewire-upload-progress="progress = $event.detail.progress"
                                    >
                                        <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow image-edit" >
                                            <i class="fa fa-pen icon-sm text-muted"></i>
                                            <input wire:model.defer="imageTmp" type="file" name="profile_avatar" accept=".png, .jpg, .jpeg" class="d-none"/>
                                        </label>

                                        <!-- Progress Bar -->
                                        <div x-show="isUploading">
                                            <progress max="100" x-bind:value="progress"></progress>
                                        </div>
                                    </div>
                                    @if ($imageTmp || $expense->image)
                                    <span 
                                        wire:click="removeImage()"
                                        wire:loading.class="spinner spinner-primary spinner-sm" wire:target="removeImage"
                                        class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow image-remove" 
                                        title="Remover imagen">
                                        <i class="ki ki-bold-close icon-xs text-muted"></i>
                                    </span>
                                    @endif
                                </div>
                                @error('imageTmp') 
                                    <div>
                                        <span class="text-danger">{{ $message }}</span>
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <div wire:ignore wire:key="date">
                                        <label class="col-form-label">Fecha de gasto <span class="text-danger">*</span></label>
                                        <div class="input-group input-group-solid">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="la la-calendar"></i>
                                                </span>
                                            </div>
                                            <input
                                                wire:model.defer="expense.date"
                                                value="{{ $expense->start_date }}"
                                                type="text" 
                                                class="date form-control form-control-solid @error('expense.date') is-invalid @enderror"  
                                                placeholder="Seleccione la fecha de gasto"
                                                />
                                        </div>
                                    </div>
                                    
                                    @error('expense.date') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-lg-6">
                                    <label class="col-form-label">Concepto <span class="text-danger">*</span></label>
                                    <div class="input-group input-group-solid" >
                                        <input 
                                            wire:model.defer="expense.concept" 
                                            type="text" 
                                            required
                                            class="form-control form-control-solid @error('expense.concept') is-invalid @enderror" 
                                            placeholder="Ej: Identificador de gasto" />
                                    </div>
                                    @error('expense.concept') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label class="col-form-label">Cliente </label>
                                    <div wire:ignore wire:key="client" >
                                        <select 
                                            wire:change="clientChange($event.target.value)"
                                            wire:model.defer="expense.client_id" 
                                            class="form-control selectpicker form-control-solid @error('expense.client_id') is-invalid @enderror" 
                                            data-size="7"
                                            data-live-search="true"
                                            data-show-subtext="true"
                                            >
                                            <option value="">Ninguno</option>
                                            @foreach ($clients as $c)
                                                <option data-subtext="{{ $c->company }}" value="{{ $c->id }}">{{ $c->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <span class="form-text text-muted">Elije el cliente correspondiente al gasto</span>
                                    @error('expense.client_id') <div><span class="text-danger">{{ $message }}</span></div> @enderror
                                </div>
                                <div class="col-lg-6">
                                    <label class="col-form-label">Cuenta <span class="text-danger">*</span></label>
                                    <div wire:ignore wire:key="account">
                                        <select 
                                            wire:model.defer="expense.account_id" 
                                            class="form-control selectpicker form-control-solid @error('expense.account_id') is-invalid @enderror" 
                                            data-size="7"
                                            data-live-search="true"
                                            required>
                                            <option value="">Selecciona una cuenta</option>
                                            @foreach ($accounts as $account)
                                                <option value="{{ $account->id }}">{{ $account->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <span class="form-text text-muted">Elije la cuenta que será afectada al gasto</span>
                                    @error('expense.account_id') <div><span class="text-danger">{{ $message }}</span></div> @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label class="col-form-label">Categoría de gasto <span class="text-danger">*</span></label>
                                    <div>
                                        <select 
                                            wire:model.defer="expense.category_expense_id" 
                                            class="form-control selectpicker form-control-solid @error('expense.category_expense_id') is-invalid @enderror" 
                                            data-size="7"
                                            data-live-search="true"
                                            required>
                                            <option value="">Selecciona un tipo de categoría</option>
                                            @foreach ($categoryExpenses as $categoryExpense)
                                                <option value="{{ $categoryExpense->id }}">{{ $categoryExpense->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <span class="form-text text-muted">Elije el tipo de categoría</span>
                                    <a href="#"  data-toggle="modal" data-target="#categoryExpenseFormModal" class="text-primary" >Crear categoría de gasto</a>
                                    @error('expense.category_expense_id') <div><span class="text-danger">{{ $message }}</span></div> @enderror
                                </div>
                                <div class="col-lg-6">
                                    <label class="col-form-label">Monto <span class="text-danger">*</span></label>
                                    <div class="input-group input-group-solid">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-dollar-sign"></i>
                                            </span>
                                        </div>
                                        <input 
                                            wire:model.defer="expense.monto" 
                                            type="number" 
                                            required
                                            class="form-control form-control-solid @error('expense.monto') is-invalid @enderror" 
                                            placeholder="Ej: 8000" />
                                    </div>
                                    @error('expense.monto') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-12">
                                    <label class="col-form-label">Nota </label>
                                    <div class="input-group input-group-solid">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-comments"></i>
                                            </span>
                                        </div>
                                        <textarea 
                                            wire:model.defer="expense.note"
                                            name="" 
                                            id="" 
                                            cols="30" 
                                            rows="10"
                                            class="form-control form-control-solid @error('expense.note') is-invalid @enderror" 
                                        ></textarea>
                                    </div>
                                    @error('expense.note') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>

                        

                        <div
                            wire:loading
                            wire:target="clientChange"   
                            class="spinner spinner-success"></div>
                        @if ($client->services->count())
                            <div class="separator separator-dashed my-10"></div>
                            <div class="my-5">
                                <h3 class="text-dark font-weight-bold mb-10">Seleccionar servicios correspondientes al gasto</h3>
                                <div class="form-group m-0">
                                    <div class="row" wire:loading.remove wire:target="clientChange">
                                        @forelse ($client->services as $service)
                                        <div class="col-lg-6">
                                            <label class="option">
                                                <span class="option-control">
                                                    <span class="checkbox">
                                                        <input 
                                                            wire:model.defer="serviceArray"
                                                            type="checkbox" 
                                                            name="serviceArray[]" 
                                                            value="{{ $service->id }}" 
                                                        />
                                                        <span></span>
                                                    </span>
                                                </span>
                                                <span class="option-label">
                                                    <span class="option-head">
                                                        <span class="option-title">{{ $service->name }}</span>
                                                        <span class="option-focus">{{ $service->priceToString() }}</span>
                                                    </span>
                                                    <span class="option-body">{{ $service->note }}</span>
                                                </span>
                                            </label>
                                        </div>
                                        @empty
                                            <span class="badge badge-secondary">No se encontró ningun servicio ligado a este cliente</span>
                                        @endforelse
                                    </div>
                                </div>
                                
                            </div>
                        @endif

                        @role('Administrador')

                        <div class="separator separator-dashed my-10"></div>

                        <div class="my-5">
                            <h3 class="text-dark font-weight-bold mb-10">Pertenece al usuario</h3>
                            <div class="form-group row">
                                <label class="col-3">Usuario</label>
                                <div class="col-9">
                                    <div wire:ignore wire:key="user">
                                        <select 
                                            wire:model.defer="userId" 
                                            class="form-control selectpicker form-control-solid @error('userId') is-invalid @enderror" 
                                            data-size="7"
                                            data-live-search="true"
                                            data-show-subtext="true"
                                        >
                                            <option value="">Ninguno</option>
                                            @foreach ($users as $user)
                                                <option data-subtext="{{ $user->position }}" value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <span class="form-text text-muted">Este es el usuario responsable del gasto</span>
                                    @error('userId') <div><span class="text-danger">{{ $message }}</span></div> @enderror
                                </div>
                            </div>
                        </div>

                        @endrole
                    </div>
                    <div class="col-xl-2"></div>
                </div>
                <button class="d-none" type="submit"></button>
            </form>
            <!--end::Form-->
        </div>
    </div>
    <!--end::Card-->

    @section('footer')
        <script src="{{ asset('assets/plugins/custom/bfi/bfi.js') }}"></script>
        <script src="{{ asset('assets') }}/js/pages/crud/forms/widgets/bootstrap-datepicker.js"></script>
        <script>

            function app() {
                return {
                    removeFile(functionRemove, fileId) { 
                        @this.call(functionRemove);
                        bfi_clear('#'+fileId);
                    },
                }
            }

            Livewire.on('renderJs', function(){
                $('#categoryExpenseFormModal').modal('hide');
                $('.selectpicker').selectpicker({
                    liveSearch: true,
                    showSubtext: true
                });
            });

            // Init date
            $('.date').datepicker({
                format: "yyyy/mm/dd",
                todayBtn: "linked",
                clearBtn: true,
                todayHighlight: true,
                autoclose: true,
                language: 'es',
                orientation: "bottom left",
            }).on('changeDate', function(e){
                @this.set('expense.date', e.target.value);
            });

        </script>
    @endsection
        
</div>
