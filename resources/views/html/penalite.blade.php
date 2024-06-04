@extends('parent')
@section('main')
      <!--  Header End -->
      <div class="container-fluid"> 
        <div class="modal fade" id="deleteForm" tabindex="-1" aria-labelledby="deleteFormLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="deleteFormLabel">Voulez-vous vraiment supprimer cette pénalité?</h5>
                  </div>
                  <div class="modal-body">
                      <form method="POST" action="/supprimerPenalite">
                          @csrf
                          <input type="hidden" name="idetape" id="idetapeInput" value="">
                          <input type="hidden" name="idequipe" id="idequipeInput" value="">
                          <input type="hidden" name="idpenalite" id="idpenaliteInput" value="">
                 
                          <button type="submit" id="submitBtn" class="btn btn-primary">OUI</button>
                      <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal" aria-label="Close">NON</button> 
                      </form>
                      
                  </div>
                  
                </div>
            </div>
        </div>
        <!--  Row 1 -->
          <div class="row">
            <div class="col-lg-8 d-flex align-items-stretch">
              <div class="card w-100"> 
                <div class="card-body p-4">
                  <h5 class="card-title fw-semibold mb-4">Pénalités</h5>
                  <div class="table-responsive">
                <table class="table text-nowrap mb-0 align-middle">
                  <thead class="text-dark fs-4">
                    <tr>
                    
                      <th class="">
                        <h6 class="fw-semibold mb-0">Etape</h6>
                      </th>
                      <th class="">
                        <h6 class="fw-semibold mb-0">Equipe</h6>
                      </th>
                      <th class="">
                        <h6 class="fw-semibold mb-0">Temps de pénalité</h6>
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($penalites as $penalite)
                    <tr>
                        <td class="">
                          <p class="mb-0 fw-normal">{{ $penalite->nometape }}</p>
                        </td>
                        <td class="">
                          <p class="mb-0 fw-normal"> {{ $penalite->nomequipe }}</p>
                        </td>
                        <td class="">
                            <p class="mb-0 fw-normal"> {{ $penalite->tempspenalite }}</p>
                        </td>
                        <td class="">
                          <a href="#"  
                            class="btn btn-danger rounded-circle p-2 text-white d-inline-flex" id="delete-link" data-bs-toggle="tooltip" data-bs-placement="top" 
                            data-idetape="{{ $penalite->idetape }}" 
                            data-idequipe="{{ $penalite->idequipe }}"
                            data-idpenalite="{{ $penalite->idpenalite }}">
                            <i class="ti ti-minus fs-4"></i>
                          </a>
                        </td>
                        
                    </tr>
                    @endforeach
                  </tbody>
                </table>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-8 d-flex align-items-stretch">
              @if(session()->has('success'))
              <div class="alert alert-success" role="alert">
                  {{ session()->get('success') }}
              </div>
              @endif
      
              @if($errors->any())
              <div class="alert alert-danger" role="alert">
                  <ul>
                      @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                      @endforeach
                  </ul>
              </div>
              @endif
            </div>
            <div class="col-lg-8 d-flex align-items-stretch">
              <div class="card w-100">
                  <div class="card-body p-6">
                      <h5 class="card-title fw-semibold mb-4">Ajout Pénalité</h5>
                        <div class="table-responsive">
                          <form method="POST" action="/insertPenalite">
                              @csrf
                                <div class="mb-3">

                                  <select class="form-select" name="idetape" id="idetape">
                                    <option value="">Selectionner une étape</option>
                                    @foreach ($etapes as $etape)
                                    <option value="{{ $etape->idetape }}" {{ old('idetape') == $etape->idetape ? 'selected' : '' }}>{{ $etape->nometape }}</option>
                                    @endforeach
                                  </select>
                                </div>
                                
                                <div class="mb-3">
                                  <select class="form-select" name="idequipe" id="idequipe">
                                    <option value="">Selectionner une equipe</option>
                                    @foreach ($equipes as $equipe)
                                    <option value="{{ $equipe->idequipe }}" {{ old('idequipe') == $equipe->idequipe ? 'selected' : '' }}>{{ $equipe->nomequipe }}</option>
                                    @endforeach
                                  </select>    
                                </div>
                                <div class="mb-3">
                                  <label for="tempsPenalite" class="form-label">Pénalite</label>
                                  <input type="time" step="1" class="form-control"  name="tempsPenalite" id="">
                                </div>
                              <button type="submit" id="submitBtn" class="btn btn-primary">Valider</button>
                          </form>
                        </div>
                  </div>
              </div>
            </div>
          </div>
      </div>
      </div>  
</body>
<script src="../assets/libs/jquery/dist/jquery.min.js"></script>
<script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="../assets/js/sidebarmenu.js"></script>
<script src="../assets/js/app.min.js"></script>
<script>
  $(document).ready(function() {
  $('a.btn.btn-danger.rounded-circle.p-2.text-white.d-inline-flex').on('click', function(e) {
      e.preventDefault();
      
      // Récupérer les données attribut du lien
      var idequipe = $(this).data('idequipe');
      var idetape = $(this).data('idetape');
      var idpenalite = $(this).data('idpenalite');
      
      $('#idetapeInput').val(idetape);
      $('#idequipeInput').val(idequipe);
      $('#idpenaliteInput').val(idpenalite);

      // Initialiser le modal
      var deleteModal = new bootstrap.Modal(document.getElementById('deleteForm'));

      // Afficher le modal
      deleteModal.show();

  });
});
</script>
</html>
@endsection