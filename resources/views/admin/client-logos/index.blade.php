@extends('admin.layouts.app')

@section('title', 'Logos clients')
@section('page-title', 'Logos clients')

@section('content')

    @if (session('success'))
        <div class="alert">{{ session('success') }}</div>
    @endif

    <div class="card">

        <div style="display:flex;justify-content:space-between;align-items:center;gap:15px;margin-bottom:20px;">
            <div>
                <h2 style="margin:0;font-size:17px;font-weight:600;color:#111827;">
                    Références clients
                </h2>
                <p style="margin:5px 0 0;font-size:13px;color:#6b7280;">
                    {{ $clientLogos->total() }} logo(s)
                    — Glissez les logos pour modifier leur ordre.
                </p>
            </div>

            <a href="{{ route('admin.client-logos.create') }}" class="btn">
                + Ajouter un logo
            </a>
        </div>

        <div id="reorder-status" role="status" style="margin-bottom:15px;"></div>

        <div id="client-logos-list"
             data-reorder-url="{{ route('admin.client-logos.reorder') }}"
             style="display:grid;grid-template-columns:repeat(auto-fill,minmax(190px,1fr));gap:15px;">

            @forelse ($clientLogos as $clientLogo)
                <div class="client-logo-item"
                     data-id="{{ $clientLogo->id }}"
                     style="border:1px solid #e5e7eb;border-radius:10px;padding:15px;background:#fff;">

                    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:12px;">
                        <button type="button"
                                class="drag-handle"
                                title="Glisser pour déplacer"
                                aria-label="Déplacer {{ $clientLogo->name }}"
                                style="cursor:grab;border:1px solid #e5e7eb;border-radius:6px;background:#f9fafb;padding:6px 10px;">
                            ⠿ Déplacer
                        </button>

                        <span style="font-size:12px;color:#6b7280;">
                            #{{ $clientLogo->position + 1 }}
                        </span>
                    </div>

                    <div style="height:100px;display:flex;align-items:center;justify-content:center;margin-bottom:12px;">
                        <img src="{{ str_starts_with($clientLogo->image, 'assets/')
                ? asset($clientLogo->image)
                : asset('storage/' . $clientLogo->image) }}"
                             alt="{{ $clientLogo->name }}"
                             loading="lazy"
                             style="max-width:100%;max-height:90px;object-fit:contain;">
                    </div>

                    <div style="font-weight:600;color:#111827;margin-bottom:8px;">
                        {{ $clientLogo->name }}
                    </div>

                    <div style="margin-bottom:12px;">
                        @if ($clientLogo->is_active)
                            <span style="font-size:12px;color:#059669;">Actif</span>
                        @else
                            <span style="font-size:12px;color:#dc2626;">Masqué</span>
                        @endif
                    </div>

                    <div style="display:flex;gap:8px;flex-wrap:wrap;">
                        <a href="{{ route('admin.client-logos.edit', $clientLogo) }}"
                           class="btn btn-secondary"
                           style="padding:7px 10px;font-size:12px;">
                            Modifier
                        </a>

                        <form action="{{ route('admin.client-logos.destroy', $clientLogo) }}"
                              method="POST"
                              onsubmit="return confirm('Supprimer ce logo ?')">
                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    class="btn btn-danger"
                                    style="padding:7px 10px;font-size:12px;">
                                Supprimer
                            </button>
                        </form>
                    </div>

                </div>
            @empty
                <p>Aucun logo client enregistré.</p>
            @endforelse
        </div>

        @if ($clientLogos->hasPages())
            <div style="margin-top:22px;">
                {{ $clientLogos->links('vendor.pagination.admin') }}
            </div>
        @endif

    </div>

    <style>
        .client-logo-item.sortable-ghost {
            opacity: .35;
            background: #eff6ff !important;
        }

        .client-logo-item.sortable-chosen {
            box-shadow: 0 5px 20px rgba(0,0,0,.08);
        }

        #reorder-status:empty {
            display: none;
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.6/Sortable.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const list = document.getElementById('client-logos-list');
            const status = document.getElementById('reorder-status');

            if (!list || !window.Sortable) {
                return;
            }

            let previousOrder = [];

            function getOrder() {
                return Array.from(list.querySelectorAll('.client-logo-item'))
                    .map(item => Number(item.dataset.id));
            }

            function updatePositions() {
                list.querySelectorAll('.client-logo-item').forEach((item, index) => {
                    const position = item.querySelector('span');
                    if (position) {
                        position.textContent = '#' + (index + 1);
                    }
                });
            }

            Sortable.create(list, {
                animation: 180,
                handle: '.drag-handle',
                draggable: '.client-logo-item',
                ghostClass: 'sortable-ghost',
                chosenClass: 'sortable-chosen',

                onStart: function () {
                    previousOrder = getOrder();
                    status.textContent = '';
                },

                onEnd: async function () {
                    const ids = getOrder();

                    if (JSON.stringify(ids) === JSON.stringify(previousOrder)) {
                        return;
                    }

                    status.textContent = 'Enregistrement de l’ordre...';

                    try {
                        const response = await fetch(list.dataset.reorderUrl, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content ?? '',
                            },
                            body: JSON.stringify({ ids }),
                        });

                        if (!response.ok) {
                            throw new Error('Impossible d’enregistrer le nouvel ordre.');
                        }

                        status.style.color = '#059669';
                        status.textContent = 'Ordre enregistré avec succès.';
                        updatePositions();
                    } catch (error) {
                        // Restaurer l’ordre précédent si l’enregistrement échoue.
                        const items = new Map(
                            Array.from(list.querySelectorAll('.client-logo-item'))
                                .map(item => [Number(item.dataset.id), item])
                        );

                        previousOrder.forEach(id => {
                            if (items.has(id)) {
                                list.appendChild(items.get(id));
                            }
                        });

                        status.style.color = '#dc2626';
                        status.textContent = error.message;
                        updatePositions();
                    }
                },
            });
        });
    </script>

@endsection
