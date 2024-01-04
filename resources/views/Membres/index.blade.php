<!-- resources/views/membres/index.blade.php -->

@extends('layouts.app')

@section('content')
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Membres') }}
    </h2>
</x-slot>
<div class="container my-4"> <!-- Ajout de la classe de marge my-4 -->
    <h2 class="mb-4">Liste des Membres</h2>
    <a href="{{ route('membres.create') }}" class="btn btn-dark">Ajouter un membre </a>
    <br><br>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('membres.index') }}" method="GET">
        <div class="input-group mb-3">
            <input type="text" class="form-control rounded-3" placeholder="Rechercher un membre" name="query">
            <div class="input-group-append">
                <button class="btn btn-outline-dark rounded-3" type="submit">Rechercher</button>
            </div>
            @if(request()->has('query'))
                <div class="input-group-append">
                    <a href="{{ route('membres.index') }}" class="btn btn-outline-secondary">Actualiser</a>
                </div>
                @endif
            </div>
        </form>

        <br>
        <div class="table-responsive shadow-sm rounded-3 mt-3">
            <table class="table caption-top text-capitalize">
                <thead>
                    <tr>
                        <th scope="col " class="bg-secondary text-white border-0 border-bottom-1">Photo</th>
                        <th scope="col" class="bg-secondary text-white border-0 border-bottom-1">Nom</th>
                        <th scope="col" class="bg-secondary text-white border-0 border-bottom-1">Prénom</th>
                        <th scope="col" class="bg-secondary text-white border-0 border-bottom-1">Sexe</th>
                        <th scope="col" class="bg-secondary text-white border-0 border-bottom-1">Contact</th>
                        <th scope="col" class="bg-secondary text-white border-0 border-bottom-1 " >voir</th>
                        <th scope="col" class="bg-secondary text-white border-0 border-bottom-1 " >modifier</th>
                        <th scope="col" class="bg-secondary text-white border-0 border-bottom-1 text-center" >Supprimer</th>

                    </tr>
                </thead>
                <tbody>
                    @if(isset($resultats))
                        @foreach($resultats as $membre)
                        <tr>
                            <td class="bg-white border-0">
                                <img class="rounded-5 text-center w-50 h-10"src="{{ asset('storage/photos/' . $membre->photo) }}" alt="Photo">
                            </td>


                            <td class="bg-white border-0">{{ $membre->nom }}</td>
                            <td class="bg-white border-0">{{ $membre->prenom }}</td>
                            <td class="bg-white border-0">{{ $membre->sexe }}</td>
                            <td class="bg-white border-0">{{ $membre->contact }}</td>
                            <td class="bg-white border-0">

                                <a href="{{ route('membres.show', $membre->membre_id) }}" class="nav-link">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" data-slot="icon" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    </svg>


                                </a>
                            </td>
                            <td class="bg-white border-0">

                                    <a href="{{ route('membres.edit', $membre->membre_id) }}" class="nav-link">
                                        <svg width="24" class="text-warning" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" data-slot="icon" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                        </svg>


                                    </a>

                            </td>
                            <td class="bg-white border-0 text-center">

                                <form action="{{ route('membres.destroy', $membre->membre_id) }}" method="post" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce membre?')">
                                        <svg  xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" data-slot="icon" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                        </svg>

                                    </button>
                                </form>
                            </td>

                                <!-- Ajoutez d'autres actions si nécessaire, comme la suppression -->
                            </td>
                        </tr>
                        @endforeach
                    @else
                        @foreach($membres as $membre)
                            <tr>
                                <td class="bg-white border-0">
                                    <img class="rounded-5 text-center w-50 h-10" src="{{ asset('storage/photos/' . $membre->photo) }}" alt="Photo">
                                </td>


                                <td class="bg-white border-0">{{ $membre->nom }}</td>
                                <td class="bg-white border-0">{{ $membre->prenom }}</td>
                                <td class="bg-white border-0">{{ $membre->sexe }}</td>
                                <td class="bg-white border-0">{{ $membre->contact }}</td>
                                <td class="bg-white border-0">

                                    {{-- <a href="{{ route('membres.show', $membre->membre_id) }}" class="nav-link" >
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" data-slot="icon" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                        </svg>

                                    </a> --}}
                                    <a href="{{ route('membres.show', $membre->membre_id) }}" class="nav-link">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" data-slot="icon" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                        </svg>


                                    </a>
                                </td>
                                <td class="bg-white border-0">

                                        <a href="{{ route('membres.edit', $membre->membre_id) }}" class="nav-link">
                                            <svg width="24" class="text-warning" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" data-slot="icon" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                            </svg>


                                        </a>

                                </td>
                                <td class="bg-white border-0 text-center">

                                    <form action="{{ route('membres.destroy', $membre->membre_id) }}" method="post" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce membre?')">
                                            <svg  xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" data-slot="icon" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                            </svg>

                                        </button>
                                    </form>
                                </td>
                                    <!-- Ajoutez d'autres actions si nécessaire, comme la suppression -->

                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
    </div>
</div>
@endsection
