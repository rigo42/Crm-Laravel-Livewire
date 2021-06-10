<!-- Modal -->
<div class="modal fade" wire:ignore.self id="transferProspectModal" tabindex="-1" role="dialog" aria-labelledby="transferProspectModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" >
            @if ($countProspects)
                <div class="modal-header" style="display: block;">
                    <div class="row align-items-center">
                        <div class="col-md-12 my-2 my-md-0">
                            <div class="input-icon">
                                <input 
                                    wire:model="searchProspect"
                                    type="search" 
                                    class="form-control"
                                    placeholder="Buscar prospecto...">
                                <span>
                                    <i class="flaticon2-search-1 text-muted"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-body" data-height="300" data-scroll="true" wire:ignore.self wire:key="modal-body-prospect">
                        
                    @include('component.error-list')

                    <h6 class="text-dark font-weight-bold mb-5">Selección de nuevo usuario</h6>
                    <div class="form-group row">
                        <div class="col-9">
                            <div wire:ignore wire:key="userIdNew">
                                <select 
                                    wire:model.defer="userIdNew" 
                                    class="form-control selectpicker form-control-solid @error('userIdNew') is-invalid @enderror" 
                                    data-size="7"
                                    data-live-search="true">
                                    <option value="">Ninguno</option>
                                    @foreach ($users as $userNew)
                                        <option value="{{ $userNew->id }}">{{ $userNew->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <span class="form-text text-muted">Este será el usuario responsable del cliente</span>
                            @error('userIdNew') <div><span class="text-danger">{{ $message }}</span></div> @enderror
                        </div>
                    </div>

                    <div class="separator separator-dashed my-10"></div>

                    <h6 class="text-dark font-weight-bold mb-5">Selección de prospectos</h6>
                    <div class="table-responsive">
                        <table class="table table-head-custom table-head-bg table-borderless table-vertical-center">
                            <thead>
                                <tr class="text-uppercase">
                                    <th><input x-on:click="toggleAllCheckboxes()" type="checkbox" class="select-all checkbox" name="select-all" /></th>
                                    <th>Prospecto</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($prospects as $prospect)
                                    <tr>
                                        <td><input 
                                                wire:model="prospectArray" 
                                                class="checkbox" 
                                                type="checkbox" 
                                                name="prospectArray[]"
                                                value="{{ $prospect->id }}" 
                                            /></td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="symbol symbol-circle symbol-50 mr-3">
                                                    <img 
                                                        alt="{{ $prospect->name }}" 
                                                        @if ($prospect->image)
                                                            src="{{ Storage::url($prospect->image->url) }}" 
                                                        @else
                                                            src="{{ asset('assets/media/users/blank.png') }}" 
                                                        @endif
                                                        >
                                                </div>
                                                <div class="d-flex flex-column">
                                                    <a href="{{ route('prospect.show', $prospect) }}" class="text-dark-75 text-hover-primary font-weight-bold font-size-lg">{{ $prospect->name }}</a>
                                                    <span class="text-muted font-weight-bold font-size-sm">{{ $prospect->interest }}</span>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                @empty 
                                    <!--begin::Col-->
                                    <div class="col-12">
                                        <div class="alert alert-custom alert-notice alert-light-dark fade show mb-5" role="alert">
                                            <div class="alert-icon">
                                                <i class="flaticon-questions-circular-button"></i>
                                            </div>
                                            <div class="alert-text">Sin resultados "{{ $searchProspect }}"</div>
                                        </div>
                                    </div>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    @error('prospectArray') 
                        <div>
                            <span class="text-danger">{{ $message }}</span>
                        </div>
                    @enderror
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Regresar</button>
                    <button 
                        wire:click="trasnferProspect"
                        wire:loading.class="spinner spinner-white spinner-right" 
                        wire:target="trasnferProspect" 
                        class="btn btn-primary font-weight-bolder mr-2">
                        <i class="fas fa-exchange-alt"></i>
                        Transferir prospectos
                    </button>
                </div>
            @else
                <div class="card">
                    <div class="card-body">
                        <div class="card-px text-center py-20 my-10">
                            <h2 class="fs-2x fw-bolder mb-10">Hola!</h2>
                            <p class="text-gray-400 fs-4 fw-bold mb-10">Al parecer no existe ningun prospecto para con este usuario</p>
                        </div>
                        <div class="text-center px-4 ">
                            <img class="img-fluid col-6" alt="" src="{{ asset('assets/media/ilustrations/work.png') }}">
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>