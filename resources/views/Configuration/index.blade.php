@extends('Layout.template')

@section('content')	 
            <div class="row g-3 mb-4 align-items-center justify-content-between">
                <div class="col-auto">
                    <h1 class="app-page-title mb-0">Configuration</h1>
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
                                
                                <select class="form-select w-auto" >
                                      <option selected value="option-1">All</option>
                                      <option value="option-2">This week</option>
                                      <option value="option-3">This month</option>
                                      <option value="option-4">Last 3 months</option>
                                      
                                </select>
                            </div>
                            <div class="col-auto">						    
                                <a class="btn app-btn-secondary" href="{{route('configurations.create')}}">
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-download me-1" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                                        <path fill-rule="evenodd" d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
                                        </svg>
                                    Nouvelle configuration
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
                                            <th class="cell">Type</th>
                                            <th class="cell">Valeur</th>
                                            <th class="cell">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($lesconfiguartions as $lesconfig )
                                            
                                        
                                        <tr>
                                            <td class="cell">
                                                @if ($lesconfig->type === 'PAYMENT_DATE')
                                                Date Mensuel de Paiement
                                                @elseif ($lesconfig->type === 'APP_NAME')
                                                Nom de l'application
                                                @elseif ($lesconfig->type === 'DEVELOPPER_NAME')
                                                Nom du Developpeur
                                                @elseif ($lesconfig->type === 'ANOTHER')
                                                Autre
                                                @endif

                                            </td>
                                            <td class="cell">
                                                {{$lesconfig->value}}
                                                @if ($lesconfig->type === 'PAYMENT_DATE')
                                                    <b>de chaque mois</b>
                                                @endif
                                            </td>
                                            <td class="cell">
                                                <a href="{{route('configurations.delete', $lesconfig->id)}}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="20" fill="red" class="bi bi-trash" viewBox="0 0 16 16">
                                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z"/>
                                                        <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z"/>
                                                      </svg>
                                                </a>
                                            </td>
                                            
                                        </tr>
                                        @empty 
                                        <tr>
                                            <td class="cell text-center" colspan="3" >Aucune configuration</td>
                                            
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div><!--//table-responsive-->
                           
                        </div><!--//app-card-body-->		
                    </div><!--//app-card-->
                    <nav class="app-pagination">
                        {{$lesconfiguartions->links()}}
                    </nav><!--//app-pagination-->
                    
                </div><!--//tab-pane-->
   @endsection