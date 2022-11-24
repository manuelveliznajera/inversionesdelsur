<x-modal-header title="{{$componentName}}" action="{{ $action }}" size="modal-lg" />

<div class="col-lg-12 layout-spacing">
    <div class="statbox widget box box-shadow">

        <div class="widget-content widget-content-area">
            <form class="row g-3" autocomplete="off" enctype="multipart/form-data">
                <div class="col-sm-12">
                    <label class="form-label">Nombre Completo</label>
                    <input type="text" id="focus" wire:model.lazy="name" class="form-control form-control-sm" placeholder="Melisa Albahat">
                    @error('name') <span class="text-warning">{{ $message }}</span> @enderror
                </div>
                <div class="col-sm-12 col-md-6">
                    <label class="form-label">Dpi</label>
                    <input wire:model="dpi" type="number" class="form-control form-control-sm" placeholder="12349809854">
                    @error('dpi') <span class="text-warning">{{ $message }}</span> @enderror
                </div>
                <div class="col-12 col-md-6">
                    <label class="form-label">Telefono*</label>
                    <input wire:model.defer="phone" type="text" class="form-control form-control-sm" placeholder="000 00 0000">
                    @error('phone') <span class="text-warning">{{ $message }}</span> @enderror
                </div>
                <div class="col-sm-12 col-md-9">
                    <label class="form-label">Dirección*</label>
                    <textarea wire:model="address" class="form-control form-control-sm" cols="30" rows="2" placeholder="Aldea Centro, Cuilapa Santa Rosa"></textarea>
                    @error('address') <span class="text-warning">{{ $message }}</span> @enderror
                </div>
                <div class="col-sm-12 col-md-9">
                    <label class="form-label">Referencia*</label>
                    <textarea wire:model="referencia" class="form-control form-control-sm" cols="30" rows="2" placeholder="Por la Iglesia Catolica"></textarea>
                    @error('referencia') <span class="text-warning">{{ $message }}</span> @enderror
                </div>
                <div class="col-sm-12 col-md-3">
                    
                </div>
                <div class="col-sm-12 col-md-3">
                    <label class="form-label">Foto1</label>
                    <input wire:model="foto1" accept="image/x-png,image/jpeg,image/jpg" class="form-control" type="file">
                </div>
                <div class="col-sm-12 col-md-3">
                    <label class="form-label">Foto2</label>
                    <input wire:model="foto2" accept="image/x-png,image/jpeg,image/jpg" class="form-control" type="file">
                </div>
                <div class="col-sm-12 col-md-3">
                    <label class="form-label">Foto3</label>
                    <input wire:model="foto3" accept="image/x-png,image/jpeg,image/jpg" class="form-control" type="file">
                </div>
                
                
                

            </form>
            
        </div>
    </div>
</div>


<x-modal-footer enable="{{ $btnSaveEdit }}" />