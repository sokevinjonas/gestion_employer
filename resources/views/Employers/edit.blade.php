@extends('Layout.template')


@section('content')		    
            <h1 class="app-page-title">Employers</h1>
            <hr class="mb-4">
            <div class="row g-4 settings-section">
                <div class="col-12 col-md-4">
                    <h3 class="section-title">Modifier</h3>
                    <div class="section-intro">Modifier un Employer</div>
                </div>
                <div class="col-12 col-md-8">
                    <div class="app-card app-card-settings shadow-sm p-4">
                        
                        <form class="settings-form" method="post" action="{{route('employer.update', $employer->id)}}">
                        @csrf
                        @method('put')
                        <div class="mb-3">
                            <label for="setting-input-3" class="form-label">DEPARTEMENT</label>
                            <select name="departement_id" class="form-control">
                                @foreach ($departements as $departement )
                                <option value="{{$departement->id}}" {{$employer->departement_id === $departement->id ? 'selected': ''}}>
                                    {{$departement->nom}}
                                </option>                                    
                                @endforeach
                            </select>
                        </div>

                        <div class="app-card-body">
                                <div class="mb-3">
                                    <label for="setting-input-1" class="form-label">Nom<span class="ms-2" data-container="body" data-bs-toggle="popover" data-trigger="hover" data-placement="top" data-content="This is a Bootstrap popover example. You can use popover to provide extra info."><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-info-circle" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                        <path d="M8.93 6.588l-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588z"/>
                                        <circle cx="8" cy="4.5" r="1"/>
                                        </svg></span></label>
                                    <input type="text" name="nom" value="{{ $employer->nom }}"  class="form-control" id="setting-input-1">
                                    @error('nom')
                                        <div class="text-danger">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="setting-input-2" class="form-label">Prenom</label>
                                    <input type="text" name="prenom" value="{{ $employer->prenom }}" class="form-control" id="setting-input-2">
                                    @error('prenom')
                                        <div class="text-danger">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="setting-input-3" class="form-label">Address email</label>
                                    <input type="email" name="email" value="{{ $employer->email }}"  class="form-control" id="setting-input-3" value="{{old('email')}}">
                                    @error('email')
                                        <div class="text-danger">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="setting-input-3" class="form-label">Contact</label>
                                    <input type="number" name="contact" value="{{ $employer->contact }}"  class="form-control" id="setting-input-3" value="{{old('contact')}}">
                                    @error('contact')
                                        <div class="text-danger">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="setting-input-3" class="form-label">Montant mensuel</label>
                                    <input type="number" name="montant_journalier" value="{{ $employer->montant_journalier }}"  class="form-control" id="setting-input-3">
                                    @error('montant_journalier')
                                        <div class="text-danger">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>
                                <button type="submit" class="btn app-btn-primary" >Enregistrer</button>
                            </form>
                        </div><!--//app-card-body-->
                        
                    </div><!--//app-card-->
                </div>
            </div><!--//row-->
    </div><!--//app-content-->
@endsection
