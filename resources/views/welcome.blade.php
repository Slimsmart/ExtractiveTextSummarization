<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Extractive Text Summarization Project</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.1/css/fontawesome.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- Leave those next 4 lines if you care about users using IE8 -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>

    <div class="row">
        <div class="col-xl-8 mt-5 offset-xl-2">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Extractive Text Summarization</h4>
                    <div class="flex-shrink-0">
                        <ul class="nav nav-tabs-custom card-header-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="tab" href="#buy-tab" role="tab">Summarize Text</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#sell-tab" role="tab">Upload Document</a>
                            </li>
                        </ul>
                    </div>
                </div><!-- end card header -->

                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane active" id="buy-tab" role="tabpanel">
                            <div class="mx-4">
                                <form action="{{route('summarizeText')}}" method="post">
                                    @csrf
                                    <div class="form-group mb-3">
                                        <label>Article :</label>
                                        <textarea name="article" id="" cols="30" rows="4" required class="form-control" placeholder="Type/Paste newspaper article">@if(Session('original')){{Session('original')}}@endif</textarea>
                                        @error('article')
                                            <p class="text-danger"> <small> {{$message}}</small> </p>
                                        @enderror
                                    </div>

                                    <div class="text-center">
                                        <button type="submit" class="btn btn-success w-md">Summarize</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- end tab pane -->

                        <div class="tab-pane" id="sell-tab" role="tabpanel">
                            <div class="mx-4">
                                <form action="{{route('summarizeDocument')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group mb-3">
                                        <label>Article (Word documents only):</label>
                                        <input type="file" name="doc" id="" required class="form-control" accept=".docx">
                                        @error('doc')
                                            <p class="text-danger"> <small> {{$message}}</small> </p>
                                        @enderror
                                    </div>

                                    <div class="">
                                        <button type="submit" class="btn btn-danger w-md">Summarize</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- end tab pane -->
                    </div>
                    <!-- end tab content -->
                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->
    </div>

    @if(Session('summarized'))
        <div class="row mt-5">
            <div class="col-xl-10 offset-xl-1 px-4">
                <h3 class="text-bold">Result of summarized text</h3>
                @foreach (Session('summarized') as $p)
                    <p>{{$p}}</p>
                @endforeach
            </div>
        </div>        
    @endif

    <!-- Including Bootstrap JS (with its jQuery dependency) so that dynamic components work -->
    <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

  </body>
</html>