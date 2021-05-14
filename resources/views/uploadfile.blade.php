@extends('frontend/layouts/app')
@section('content')

    
        <div class="card-deck">
           <div class="col-xl-12">
              <div class="dash-table-cover">
                  <form action="{{route('upload_excel')}}" method="post" id="landlord_add_form" enctype="multipart/form-data" class="padding-for-label">
                  @csrf
                  <div class="manage-bk-text">
                    <h4>Upload Excel File:-</h4>
                    <div class="go-bk">
                        <div class="d-flex">
                            <a class="btn un-btn" href="{{route('welcome')}}">
                             Cancel 
                            </a>
                          <button class="btn un-btn" type="submit" href="javascritp:;"> Submit </button>
                        </div>
                    </div>
                  </div>
                  <div class="property-opt">
                    <div class="pdd-opt">
                      <div class="row land-lord">

                        <div class="col-md-6">
                          <div class="form-Documents">
                            <h4>Upload File</h4>
                            <div class="form-box">
                              <div class="input-box-ui upload-document-box">
                                <div class="file-upload-form">
                                  <input type="file" name="document" class="form-control" required>
                                </div>
                              </div>
                              <div class="form-box-content mt-3">
                                <div class="text-center mt-3">
                                  <button type="button" class="btn btn-blue">Upload</button>
                                </div>
                                @error('document')
                                <span class="error">{{$message}}</span>
                                @enderror
                                <p class="uploadedfiledata"></p>

                              </div>
                            </div>
                          </div>
                          <div class="gallery" style="text-align: center; margin-top: 20px;"></div>
                          
                        </div>
                      </div>
                    </div>

                  </div>

              </div>
           </div>
        </div>
    
@endsection
