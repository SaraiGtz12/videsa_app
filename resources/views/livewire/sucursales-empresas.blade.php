<div>
    <div class="row">
        <div class="col">
            <div class="mb-2">
                <span>Seleccionar Empresa</span>
                <select class="form-select select2" name="empresa" wire:model.live="empresaId" style="width: 100%;" required>
                    <option value="">Seleccionar Empresa</option>
                    @foreach ($empresas as $empresa)
                        <option value="{{ $empresa->id_cliente }}">{{ $empresa->razon_social}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col">
            <div class="mb-6">
                <span>Seleccionar Sucursal</span>
                <select class="form-select select2" name="sucursal" wire:model="sucursalId" style="width: 100%;" required>
                    <option value="">Seleccionar Sucursal</option>
                    @foreach ($sucursales as $sucursal)
                        <option value="{{ $sucursal->id_sucursal }}">{{ $sucursal->nombre}}</option>
                    @endforeach

                </select>
            </div>
        </div>
    </div>
</div>
