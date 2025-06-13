<div>
    <div class="row">
        <div class="col">
            <div class="mb-3">
                <span>Seleccionar Empresa</span>
                <select class="form-select" name="empresa" id="empresa" wire:model.live="empresaId" required>
                    <option value="">Seleccionar Empresa</option>
                    @foreach ($empresas as $empresa)
                        <option value="{{ $empresa->id_cliente }}">{{ $empresa->razon_social}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col">
            <div class="mb-3">
                <span>Seleccionar Sucursal</span>
                <select class="form-select" name="sucursal" wire:model="sucursalId" required>
                    <option value="">Seleccionar Sucursal</option>
                    @foreach ($sucursales as $sucursal)
                        <option value="{{ $sucursal->id_sucursal }}">{{ $sucursal->nombre}}</option>
                    @endforeach

                </select>
            </div>
        </div>
    </div>
</div>
