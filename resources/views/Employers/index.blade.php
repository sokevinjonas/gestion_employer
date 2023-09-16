@extends('Layout.template')

@section('content')	 
            <div class="row g-3 mb-4 align-items-center justify-content-between">
                <div class="col-auto">
                    <h1 class="app-page-title mb-0">Employer</h1>
                </div>
                <div class="col-auto">
                     <div class="page-utilities">
                        <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                            <div class="col-auto">
                                <form class="table-search-form row gx-1 align-items-center">
                                    <div class="col-auto">
                                        <input type="text" id="search-orders" name="searchorders" class="form-control search-orders" placeholder="Search">
                                    </div>
                                    <div class="col-auto">
                                        <button type="submit" class="btn app-btn-secondary">Search</button>
                                    </div>
                                </form>
                                
                            </div><!--//col-->
                            <div class="col-auto">						    
                                <a class="btn app-btn-secondary" href="{{route('employer.create')}}">
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-download me-1" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                                        <path fill-rule="evenodd" d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
                                        </svg>
                                    Ajouter un Employer
                                </a>
                            </div>
                        </div><!--//row-->
                    </div><!--//table-utilities-->
                </div><!--//col-auto-->
            </div><!--//row-->
            <div class="row mt-2 mb-2">
                @if(Session::get('message_success'))
            <div class="alert alert-success">
                <b>BRAVO: </b>{{Session::get('message_success')}}
            </div>
            @endif
            <div class="row mt-2 mb-2">
                @if(Session::get('message_delete'))
            <div class="alert alert-danger">
                <b>ALERTE: </b>{{Session::get('message_delete')}}
            </div>
            @endif
            </div>
            <div class="tab-content" id="orders-table-tab-content">
                <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
                    <div class="app-card app-card-orders-table shadow-sm mb-5">
                        <div class="app-card-body">
                            <div class="table-responsive">
                                <table class="table app-table-hover mb-0 text-left">
                                    <thead>
                                        <tr>
                                            <th class="cell">DEPARTEMNET</th>
                                            <th class="cell uppercase-text">Nom</th>
                                            <th class="cell uppercase-text">Prenom(s)</th>
                                            <th class="cell uppercase-text">Contact</th>
                                            <th class="cell uppercase-text">Salaire</th>
                                            <th class="cell uppercase-text" colspan="2">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($employers as $employer )
                                         
                                        <tr>
                                            <td class="cell">
                                                @if ($employer->departement)
                                                    {{ $employer->departement->nom }}
                                                @endif
                                            </td>
                                            <td class="cell"><span>{{ $employer->nom}}</span></td>
                                            <td class="cell">{{ $employer->prenom}}</td>
                                            <td class="cell"><span >{{ $employer->contact}}</span></td>
                                            <td class="cell">
                                                <button class="btn btn-success btn-sm text-white">{{ $employer->montant_journalier}} XOF</button>
                                            </td>
                                            <td class="cell">
                                                <a href="{{route('employer.edit', $employer->id)}}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="20" fill="blue" class="bi bi-box-arrow-up-right" viewBox="0 0 16 16">
                                                        <path fill-rule="evenodd" d="M8.636 3.5a.5.5 0 0 0-.5-.5H1.5A1.5 1.5 0 0 0 0 4.5v10A1.5 1.5 0 0 0 1.5 16h10a1.5 1.5 0 0 0 1.5-1.5V7.864a.5.5 0 0 0-1 0V14.5a.5.5 0 0 1-.5.5h-10a.5.5 0 0 1-.5-.5v-10a.5.5 0 0 1 .5-.5h6.636a.5.5 0 0 0 .5-.5z"/>
                                                        <path fill-rule="evenodd" d="M16 .5a.5.5 0 0 0-.5-.5h-5a.5.5 0 0 0 0 1h3.793L6.146 9.146a.5.5 0 1 0 .708.708L15 1.707V5.5a.5.5 0 0 0 1 0v-5z"/>
                                                      </svg>
                                                </a>
                                            </td>
                                            <td class="cell">
                                                <a href="{{route('employer.delete', $employer->id)}}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="20" fill="red" class="bi bi-trash" viewBox="0 0 16 16">
                                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z"/>
                                                        <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z"/>
                                                      </svg>
                                                </a>
                                            </td>
                                        </tr>
                                        @empty 
                                        <tr>
                                            <td class="cell text-center" colspan="5" >Aucun Employer Ajouter</td>
                                            
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div><!--//table-responsive-->
                           
                        </div><!--//app-card-body-->		
                    </div><!--//app-card-->
                    <nav class="app-pagination">
                        {{ $employers->links() }}
                    </nav><!--//app-pagination-->
                    
                </div><!--//tab-pane-->
@endsection