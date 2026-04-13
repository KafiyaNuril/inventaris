@extends('layouts.app')
@section('content')
    <div class="container card p-4 w-50">
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('lending.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name"
                    placeholder="name">
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div id="items-container">
                <div class="item-row border rounded p-3 mb-3 position-relative">

                    <button type="button" class="btn-close btn-outline-secondary text-dark btn-sm remove-item float-end"
                        aria-label="Close"></button>

                    <div class="my-3">
                        <label for="items" class="form-label">Items</label>
                        <select name="items[]" class="form-select item-select @error('item_id') is-invalid @enderror"">
                            <option disabled selected>Select Items</option>
                            @foreach ($items as $item)
                                <option value="{{ $item->id }}" data-stock="{{ $item->available }}">
                                    {{ $item->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('item_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="total" class="form-label">Total</label>
                        <input type="number" name="totals[]" class="form-control qty-input" placeholder="total item">
                        @error('total')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                </div>
            </div>

            <button type="button" id="add-item" class="btn mb-3 text-info"><i class="bi bi-chevron-down"></i> more</button>

            <div class="mb-3">
                <label for="notes" class="form-label">Ket</label>
                <input type="text" class="form-control @error('notes') is-invalid @enderror" id="notes"
                    placeholder="notes" name="notes">
                @error('notes')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <script>
        const container = document.getElementById('items-container');

        function toggleRemoveButtons() {
            const rows = document.querySelectorAll('.item-row');

            rows.forEach(row => {
                const btn = row.querySelector('.remove-item');
                btn.style.display = rows.length === 1 ? 'none' : 'block';
            });
        }

        // ➕ tambah item
        document.getElementById('add-item').onclick = function() {
            const firstRow = document.querySelector('.item-row');
            const newRow = firstRow.cloneNode(true);

            // reset value
            newRow.querySelector('.item-select').selectedIndex = 0;
            newRow.querySelector('.qty-input').value = '';

            const errorText = newRow.querySelector('.error-text');
            if (errorText) {
                errorText.classList.add('d-none');
                errorText.textContent = '';
            }

            container.appendChild(newRow);

            toggleRemoveButtons();
        };

        // ❌ hapus item
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-item')) {
                e.target.closest('.item-row').remove();
                toggleRemoveButtons();
            }
        });

        // ⚠️ validasi stock TANPA ALERT
        document.addEventListener('input', function(e) {
            if (e.target.classList.contains('qty-input')) {
                const row = e.target.closest('.item-row');
                const select = row.querySelector('.item-select');
                const errorText = row.querySelector('.error-text');

                const stock = select.selectedOptions[0]?.dataset.stock || 0;
                const value = parseInt(e.target.value) || 0;

                if (value > stock) {
                    if (errorText) {
                        errorText.textContent = 'Total item melebihi stok';
                        errorText.classList.remove('d-none');
                    }
                    e.target.classList.add('is-invalid');
                } else {
                    if (errorText) {
                        errorText.textContent = '';
                        errorText.classList.add('d-none');
                    }
                    e.target.classList.remove('is-invalid');
                }
            }
        });

        // init
        document.addEventListener('DOMContentLoaded', function() {
            toggleRemoveButtons();
        });
    </script>
@endsection
