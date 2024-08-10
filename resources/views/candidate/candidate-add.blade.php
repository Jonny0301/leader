@extends('template.main')
@section('title', 'Cadastro Online')
@section('content')

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    @endpush

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#neighbour').select2();
            $('#neighbour').next('.select2-container').find('input, .select2-selection').removeClass().addClass('form-control');
        });
    </script>
  @endpush
    
  

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">@yield('title')</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item"><a href="/barang">Leader</a></li>
            <li class="breadcrumb-item active">@yield('title')</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <div class="text-right">
                <a href="/barang" class="btn btn-warning btn-sm"><i class="fa-solid fa-arrow-rotate-left"></i>
                  Back
                </a>
              </div>
            </div>
            <form class="needs-validation" novalidate action="/candidate/store_candidate" method="POST">
              @csrf
              <div class="card-body">
              <div class="row">
                  <div class="col-lg-12">
                    <div class="form-group">
                      <label for="leader">Cadastrador</label>
                      <input type="text" style="cursor: not-allowed" name="leader" class="form-control @error('leader') is-invalid @enderror" id="leader"  value="{{old('leader',$barang->name)}}" disabled>
                      <input type="text" style="display:none" name="leader_id" class="form-control @error('leader_id') is-invalid @enderror"   value="{{old('leader_id',$barang->id)}}">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label for="pending">Pendentes</label>
                      <input type="text" name="pending" class="form-control @error('pending') is-invalid @enderror" id="pending" value="{{old('pending',$pending)}}" disabled>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label for="name">Aprovados</label>
                      <input type="text" name="approve" class="form-control @error('approve') is-invalid @enderror" id="approve" value="{{old('approve',$approve)}}" disabled>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label for="fullname">Nome Completo</label>
                      <input type="text" name="fullname" class="form-control @error('fullname') is-invalid @enderror" id="fullname" placeholder="Adam Evans" value="{{old('fullname')}}" required>
                      @error('fullname')
                      <span class="invalid-feedback text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label for="nickname">Apelido</label>
                      <input type="text" name="nickname" class="form-control @error('nickname') is-invalid @enderror" id="nickname" placeholder="" value="{{old('nickname')}}" required>
                      @error('nickname')
                      <span class="invalid-feedback text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-group">
                        <label for="gender">Gênero</label>
                        <select name="gender" id="gender" class="form-control @error('gender') is-invalid @enderror">
                            <option value="" disabled selected></option>
                            <option value="0">Masculino</option>
                            <option value="1">Feminino</option>
                            <option value="2">Outro</option>
                        </select>
                      @error('gender')
                      <span class="invalid-feedback text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label for="phone">Telefone</label>
                      <!-- <div class="flag-container" style="pointer-events: none;"><div class="selected-flag" role="combobox" aria-owns="country-listbox" title="Brazil (Brasil): +55"><div class="iti-flag br"></div><div class="selected-dial-code">+55</div><div class="iti-arrow" style="display: none;"></div></div></div> -->
                      <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" id="phone" placeholder="+55 2342342" value="{{old('phone')}}" required>
                      @error('phone')
                      <span class="invalid-feedback text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label for="mail">E-mail</label>
                      <input type="text" name="mail" class="form-control @error('mail') is-invalid @enderror" id="mail" placeholder="someone@gmail.com" value="{{old('mail')}}" required>
                      @error('mail')
                      <span class="invalid-feedback text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label for="birthday">Data de nascimento</label>
                      <input type="date" name="birthday" class="form-control @error('birthday') is-invalid @enderror" id="birthday" placeholder="https://rafaelribeirooficial.com/cadastro/?ID=3914221000025495577" value="{{old('birthday')}}" required>
                      @error('birthday')
                      <span class="invalid-feedback text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-group">
                        <label for="neighbour">EBairro</label>
                        <select name="neighbour" id="neighbour" class="form-control @error('neighbour') is-invalid @enderror">
                            <option value="" disabled selected></option>
                            @foreach ($neighbours as $neighbour)
                                <option value="{{$neighbour}}">{{$neighbour}}</option>
                            @endforeach
                            
                            
                        </select>
                        @error('neighbour')
                      <span class="invalid-feedback text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label for="address">Endereço</label>
                      <input type="text" name="address" class="form-control @error('address') is-invalid @enderror" id="price"  value="{{old('address')}}" required>
                      @error('address')
                      <span class="invalid-feedback text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer text-right">
                <button class="btn btn-success" type="submit"><i class="fa-solid fa-floppy-disk"></i>
                    ENVIAR</button>
                <button class="btn btn-dark mr-1" type="reset"><i class="fa-solid fa-arrows-rotate"></i>
                  Restaurar</button>
              </div>
            </form>
          </div>
        </div>
        <!-- /.content -->
      </div>
    </div>
  </div>
</div>



@endsection