<x-modal-header title="PAGOS" action="PRESTAMOS" size="modal-lg" />

<div class="col-lg-12 layout-spacing">
    <div class="statbox widget box box-shadow">

        <div class="widget-content widget-content-area">
            <form class="row g-3" autocomplete="off">
                <div class="col-sm-12">
                    <label class="form-label">Monto</label>
                    <input type="number" id="focus" wire:model="amount" class="form-control form-control-sm" >
                    @error('amount') <span class="text-warning">{{ $message }}</span> @enderror
                </div>
            </form>

        </div>
    </div>
</div>


<x-modal-footer enable="true" />