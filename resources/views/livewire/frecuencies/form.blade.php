<x-modal-header title="{{$componentName}}" action="{{ $action }}" size="modal-sm" />

<div class="col-lg-12 layout-spacing">
    <div class="statbox widget box box-shadow">

        <div class="widget-content widget-content-area">
            <form class="row g-3" autocomplete="off">
                <div class="col-sm-12">
                    <label class="form-label">Nombre</label>
                    <input type="text" id="focus" wire:model="name" class="form-control form-control-sm" >
                    @error('name') <span class="text-warning">{{ $message }}</span> @enderror
                </div>

                <div class="col-sm-12">
                    <label class="form-label">Cantidad de Dias</label>
                    <input type="number" id="focus" wire:model="days" class="form-control form-control-sm" >
                    @error('days') <span class="text-warning">{{ $message }}</span> @enderror
                </div>
            </form>

        </div>
    </div>
</div>


<x-modal-footer enable="true" />