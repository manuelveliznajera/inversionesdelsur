<x-modal-header title="{{$componentName}}" action="{{ $action }}" size="modal-lg" />

<div class="col-lg-12 layout-spacing">
    <div class="statbox widget box box-shadow">

        <div class="widget-content widget-content-area">
            <form class="row g-3" autocomplete="off">
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
                    <textarea wire:model="address" class="form-control form-control-sm" cols="30" rows="2" placeholder="1234 Main St"></textarea>
                    @error('address') <span class="text-warning">{{ $message }}</span> @enderror
                </div>
                <div class="col-sm-12 col-md-9">
                    <label class="form-label">Referencia*</label>
                    <textarea wire:model="referencia" class="form-control form-control-sm" cols="30" rows="2" placeholder="Por la Iglesia Catolica"></textarea>
                    @error('referencia') <span class="text-warning">{{ $message }}</span> @enderror
                </div>
                <div class="col-sm-12 col-md-3">
                    <label class="form-label">Foto</label>
                    <input wire:model="avatar" accept="image/x-png,image/jpeg,image/jpg" class="form-control" type="file">
                </div>
                <div class="col-sm-12 col-md-4">
                    <label class="form-label">Salario*</label>
                    <input wire:model="salary" type="number" class="form-control form-control-sm" placeholder="25000">
                    @error('salary') <span class="text-warning">{{ $message }}</span> @enderror
                </div>
                <div class="col-sm-12 col-md-4">
                    <label class="form-label">Edad*</label>
                    <input wire:model="age" type="number" class="form-control form-control-sm" placeholder="23">
                    @error('age') <span class="text-warning">{{ $message }}</span> @enderror
                </div>
                <div class="col-sm-12 col-md-4">
                    <label class="form-label">Genero*</label>
                    <select wire:model="gender" id="cmbgender" class="form-select form-select-sm">
                        <option value="Select" selected>Select...</option>
                        <option value="Male">Masculino</option>
                        <option value="Female">Femenino</option>
                    </select>
                    @error('gender') <span class="text-warning">{{ $message }}</span> @enderror
                </div>

            </form>

        </div>
    </div>
</div>


<x-modal-footer enable="{{ $btnSaveEdit }}" />